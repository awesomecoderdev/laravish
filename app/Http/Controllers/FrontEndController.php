<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use App\Models\Sighting;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FrontEndController extends Controller
{
    public function index(Request $request,$id=null)
    {
        $fasID=$id;
        if ($fasID==null) {
            $fasID=$request->code;
        }
        if ($fasID!=null) {
            $sighting = Tag::with(['user'])->where("code", $fasID)->first();
            if ($sighting) {
                 return view('sighting', ['sighting' => $sighting, 'tag_code' => $fasID, 'tag_id' => $sighting->id ]);
            } else {
                Log::info('Invalid QR code ' . $fasID);
                sleep(1);
                return redirect()->route("index")->withErrors(["QR" => __("QR code not found")]);
            }
        } else {
            return view('sightingPrompt');
        }
    }
}

