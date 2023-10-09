<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Sighting;
use App\Mail\FeedbackMail;
use Illuminate\Http\Request;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Log;
use App\Mail\SightingSuccessMessage;
use Illuminate\Support\Facades\Mail;

class SightingController extends Controller
{
    public function add($code)
    {
        $sighting = Tag::where("code", $code)->first();
        if ($sighting === null) {
            Log::info('Invalid QR code ' . $code);
            sleep(1);
            return redirect()->route("sichtungen.prompt")->withErrors(["QR" => __("QR code not found")]);
        }
        return view('sighting', ['sighting' => $sighting, 'tag_code' => $code, 'tag_id' => $sighting->id]);
    }

    public function index()
    {
        $sightings = Sighting::with(['client'])->get();
        return view('sichtungen', ['sightings' => $sightings]);
    }


    public function redir(Request $request)
    {
        $sightings = Sighting::with(['client'])->get();
        return redirect()->route("index", $request->input("id"));
    }

    public function enter()
    {
        return view('sightingPrompt');
    }

    public function store(Request $request)
    {
        $tag = Tag::with(['user'])->where("code", $request->input("tag_id"))->first();
        $email1 = ($tag->email1 !== null) ? $tag->email1 : false;
        $email2 = ($tag->email2 !== null) ? $tag->email2 : false;
        $validTimestamp = strtotime($tag->valid_until);
        if ($validTimestamp < time()) {
            // expired
            $email1 = config("fas.admin_email");
            $email2 = false;
        }
        //    abort_if($tag->status == "expired", 404);

        $sighting = new Sighting();
        $sighting->contact = $request->contact;
        $sighting->message = $request->message;
        $sighting->tag_id = $tag->id;
        $sighting->long = $request->long ?? 0;
        $sighting->lat = $request->lat ?? 0;
        $sighting->when = strftime("%Y-%m-%d %H:%M:%S");
        $sighting->save();
        Log::info('New sighting');
        $mailSent = false;
        // mails to owner user
        if (isset($tag->user[0])) {
            if ($tag->user[0]->email) {
                Mail::to($tag->user[0]->email)->send(new NotificationMail($tag, $sighting));
                $mailSent = true;
            }
            if ($tag->user[0]->email2) {
                Mail::to($tag->user[0]->email2)->send(new NotificationMail($tag, $sighting));
                $mailSent = true;
            }
        }
        // mails to owner tag mail
        if ($email1) {
            Mail::to($email1)->send(new NotificationMail($tag, $sighting));
            $mailSent = true;
        }
        if ($email2) {
            Mail::to($email2)->send(new NotificationMail($tag, $sighting));
            $mailSent = true;
        }
        if (!$mailSent) {
            Log::error('No notification mail could be sent for sighting ' . json_encode($sighting));
        }
        // mails to finder
        Mail::to($request->contact)->send(new SightingSuccessMessage($request->contact, $request->message, $sighting));
        $feedbackRequestedFrom = $request->contact;
        if (strpos($feedbackRequestedFrom, "@") === false) {
            // finder only left phone number->receiver is eligible for feedback
            $feedbackRequestedFrom = $email1;
        }
        Mail::to($request->contact)->later(Carbon::now()->addMinutes(intval(config("fas.feedback_delay_mins"))), new FeedbackMail($feedbackRequestedFrom, $request->message, route("feedback", $sighting->id)));
        return redirect()->back()->with("success", "Your message has been sent successfully.");
    }
}
