<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackMail;
use App\Mail\NotificationMail;
use App\Mail\SightingSuccessMessage;
use App\Models\Sighting;
use App\Models\Tag;
use App\Models\User;
use App\Services\PaymentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ActivationController extends Controller
{
    protected PaymentService $payS;

    public function __construct(PaymentService $ps)
    {
        $this->payS = $ps;
    }

    public function index($id, Request $request)
    {
        $this->payS->setLicense($id);
        $isALicense = $this->payS->validate();
        $prefilled = "";
        if ($isALicense) {
            $prefilled = $id;
        }
        if ($request->activation != null) {
            $prefilled = $request->activation;
        }

        return view('activate', array("id" => $id, "code" => $prefilled));
    }

    public function downloadSVG($id)
    {
        $tag = Tag::where("code", $id)->first();
        if ($tag !== null) {
            header('Content-type: image/svg+xml');
            header('Content-Disposition: attachment; filename="qrcode.svg"');
            echo $tag->getImage();
        }
    }


    public function store(Request $request)
    {
        if (empty($request->input("id"))) {
            throw new \Exception("Invalid tag requested");
        }
        $tag = Tag::where("code", $request->input("id"))->first();
        $isALicense = false;
        if ($tag === null) {
            //activate a new tag for a new user with license code

            $this->payS->setLicense($request->input("id"));
            Log::info('Validating license for new tag '.json_encode($request));
            if ($this->payS->validate()) {
                Log::info('License valid, creating tag');
                $tag = new Tag();
                $tag->name = "Auto";
                $tag->generateCodes();

                $isALicense = true;
            } else {
                throw new \Exception("Invalid code submitted to be activated");
            }

        }

        if (!$isALicense) {
            if ($request->input("code") != $tag->activationcode) {
                Log::info('Invalid activation code');
                return redirect()->back()->withErrors(["code" => __("Activation codes do not match.")]);
            }
            if ($tag->status != "inactive") {
                Log::info('Attempt to activate active tag');
                return redirect()->back()->withErrors(["code" => __("Can't activate already active tag.")]);
            }
        }
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            $user = new User();
            $user->name = "Auto";
            $user->email = $request->email;
            $user->email2 = "";
            $user->password = "";
            //$user->email2 = $request->email2;
            $user->type = "user";
            $user->client_id = 1;
            if ($user->save()) {
                Log::info('Created new user for activation');
            } else {
                Log::error('Failed to create new user for activation');
            }
        }
        $tag->user_id = $user->id;
        if (empty($tag->email1)) {
            Log::debug('Setting email1 on activated tag');
            $tag->email1 = $request->email;
        } else if (empty($tag->email2)) {
            Log::debug('Setting email2 on activated tag');
            $tag->email2 = $request->email;
        }
        $tag->status = "active";
// use "geolocation" service, now consume the license and get expiration date
        if ($isALicense) {
            if ($this->payS->consume()) {
                $tag->valid_until = strftime("%Y-%m-%d %H:%M:%S", strtotime($this->payS->getExtensionDate()));

            } else {
                Log::debug('Valid but not consumeable');

                return redirect()->back()->withErrors(["code" => __("Can't reuse already used code.")]);
            }

        }
        $tag->save();

        $svg = base64_encode($tag->getImage());
        $response=view("validated", ["message" => "Ihre fas-ID wurde aktiviert! / Your tag has been activated!", "link" => route("tags.index"), "url" => route("tags.index"), "qr" => route("tags.index"), "download" => route("activation.download", $tag->code), "svg" => $svg, "url" => $tag->getSightingURL()]);
        return $response;
    }

}
