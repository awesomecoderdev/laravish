<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\User;
use App\Models\Client;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use SVG\Nodes\Embedded\SVGImage;
use SVG\SVG;
use SVG\Nodes\Shapes\SVGRect;
use Illuminate\Support\Facades\Http;
use Termwind\Components\Dd;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    protected PaymentService $payS;
    protected $uc;

    public function __construct(PaymentService $ps, UserController $uc)
    {
        $this->payS = $ps;
        $this->uc=$uc;
    }

    public function index()
    {
        $tags = [];

        if (Auth::getUser()->isAdmin()) {
            $tags = Tag::with(['client', 'user'])->orderBy("id", "DESC")->get();

        } else {
            $userid=Auth::getUser()->getAuthIdentifier();
            $tags = Tag::with(['client', 'user'])->where("user_id", $userid)->orderBy("id", "DESC")->get();

        }
        // $tags = User::all()->except(Auth::id()); // for testing purposes
        return view('tags', ['tags' => $tags]);
    }


    public function edit($id)
    {

        $tag = null;
        $sightings = [];
        if ($id == "new") {
            $tag = new Tag();
            $tag->id = -1;
            $tag['user'] = 0;
        } else if (!is_numeric($id)) {
            Log::error('Invalid edit parameter');
            throw new \Exception("invalid parameter");
        } else {
            $tag = Tag::with(['client', 'user', 'sightings'])->find($id);


            $sightings = $tag->getRelation('sightings');
            $tagCheck = Tag::where("id", $id)->where("user_id", Auth::user()->id)->count();
            Log::error('Tagcheck failed');

            abort_if(!Auth::user()->isAdmin() && !$tagCheck, 401);
        }
        $image = $tag->getImage();
        $tag["qr"] =
            base64_encode($image);
        // $tag["url"] = $tag->getSightingURL(); // old
        $tag["url"] = route('index', ['code' => $tag->code]);
        if (Auth::user()->isAdmin()) {
            $usernames = array(null => "Nobody");

            foreach (User::all() as $user) {
                $usernames[$user["id"]] = $user["name"];
            }
        } else {
            $usernames = [];
            $usernames[Auth::user()->id] = Auth::user()->name;
        }
        return view('tagEdit', ['tag' => $tag, 'usernames' => $usernames, 'sightings' => $sightings]);
    }

    public function delete($id)
    {
        if (!is_numeric($id)) {
            throw new \Exception("invalid parameter");
        }
        $tag = Tag::find($id);
        $tag->delete();
        return redirect()->route("tags.index")->with("success", "Tag Successfully Deleted!");
    }

    public function store(Request $request)
    {
        abort_if(!Auth::check(), 401);

        $expired = null;
//        $geolocation = app(\App\Providers\PaymentServiceProvider::class);
//        $geolocation->hello();
        if (!empty($request->license) && ($request->license !== null)) {

            $this->payS->setLicense($request->license);
            if (!$this->payS->consume()) {
                Log::info('License failed');
                return redirect()->back()->withErrors([
                    "license" => $this->payS->getLastMessage()
                ])->withInput();
            } else {
                $expired = strftime("%Y-%m-%d %H:%M:%S", strtotime($this->payS->getExtensionDate(null)));
                Log::debug('License successfully validated');
            }
        } else if (Auth::user()->isAdmin()) {
            $expired = date("Y-m-d H:m:s", strtotime($request->valid_until));
        }

        // dd($expired);
        // dd($request->all());
        if (!is_numeric($request->id)) {
            throw new \Exception("invalid parameter");
        }
        $tag = null;

        if (!Auth::user()->isAdmin()) {
            if ($request->id == -1) {
                if ($expired === null) {
                    return redirect()->route("tags.index")->withErrors(['message' => __('No valid license code to create a tag.')]);
                }
                // normal user creating new
                $request->count = 1;

            }
            $request->status = "active";

        }

        if ($request->id == -1) {

            $rows = "";
            $rows .= "<tr><th>#</th><th>ID</th><th>Name</th><th>Found QR</th><th>Found Link</th><th>Activation QR</th><th>Activation Link</th></tr>";

            if ($request->count === null) { // not authorized to have a request count
                $request->count = 1;
            }
            for ($i = 0; $i < $request->count; $i++) {
                Log::debug('Created {$request->count} tags');
                $tag = new Tag();
                $tag->activated = Carbon::now();
                $suffix = "";
                if ($i != 0) {
                    $suffix = " (" . ($i + 1) . ")";
                }
                $tag->name = $request->name . $suffix;

                $code = $request->code;
                if ($code!==null) {
                    $tag->code = $code;
                } else {
                    $tag->generateCodes();
                }
                // $tag->valid_until = date("Y-m-d H:m:s", strtotime($request->valid_until));
                $tag->valid_until = $expired ? $expired : date("Y-m-d H:m:s", strtotime($request->valid_until));
                $tag->comment = $request->comment;
                $activationcode = $request->activationcode;
                $tag->activationcode = $activationcode;

                $tag->generateCodes();
                $tag->status = $request->status;
                $tag->email1 = $request->email1;
                $tag->email2 = $request->email2;
                if (Auth::user()->isAdmin()) {
                    if ($request->user_id != 0) {
                        $tag->user_id = $request->user_id ? $request->user_id : Auth::user()->id;
                    }
                } else {
                    $tag->user_id = Auth::user()->id;
                };

                $tag->client_id = 1;
                $tag->save();

                if ($request->user_id != 0) {
                    $tag->user()->sync([$request->user_id]);
                }


                // Add SVG image
                $renderer = new ImageRenderer(
                //
                    new RendererStyle(400),
                    new SvgImageBackEnd()
                );//                new \BaconQrCode\Renderer\Image\Png()
                $writer = new Writer($renderer);


                // $writer->writeFile('http://127.0.0.1/foundandscan/backend/public/sighting/' . $id, 'qrcode.svg');`
                $foundLink = $tag->getSightingURL();
                $actLink = $tag->getActivationURL();
                $svgString = $writer->writeString($foundLink);
                $svgStringAct = $writer->writeString($actLink);
                $rows .= "<tr><td>" . ($i + 1) . "</td><td>{$tag->id}</td><td>{$tag->name}</td><td><img style='width:400;height:400' src='data:image/svg+xml;base64," . base64_encode($svgString) . "'/></td><td>$foundLink</td><td><img style='width:400;height:400' src='data:image/svg+xml;base64," . base64_encode($svgStringAct) . "'/></td><td>$actLink</td></tr>";

            }
            if ($i > 1) {
                die("<table  >" . $rows . "</table>");

            }
            return redirect()->route("tags.index")->with("success", __("Tag Successfully Created!"));
        } else {
            $tag = Tag::with(['client', 'user'])->find($request->id);
            $tag->name = $request->name;
            if (Auth::user()->isAdmin()) {
                $tag->code = $request->code;
            }
            if (($expired != null) && (!Auth::user()->isAdmin())) {
                // we do have a valid license for a new tag but we're updating an existing one ->
                // base the extension date on the previous validity end
                $expired = strftime("%Y-%m-%d %H:%M:%S", strtotime($this->payS->getExtensionDate(strtotime($tag->valid_until))));

            }
            if ($expired != null) {
                $tag->valid_until = $expired;
            }
            $tag->comment = $request->comment;
            $tag->activationcode = $request->activationcode;
            $tag->status = $request->status;
            $tag->email1 = $request->email1;
            $tag->email2 = $request->email2;
            if (Auth::user()->isAdmin()) {
                $tag->user_id = $request->user_id;
            } else {
                $tag->user_id = Auth::user()->id;
            }

            $tag->client_id = 1;
            $tag->save();
            if ($request->user_id !== null) {
                $tag->user()->sync([$request->user_id]);
            } else {
                $tag->user()->delete();// thankfully, this does not delete the user but only the relationship with any user
            }
            return redirect()->route("tags.index")->with("success", __("Tag Successfully Updated!"));
        }
    }
}
