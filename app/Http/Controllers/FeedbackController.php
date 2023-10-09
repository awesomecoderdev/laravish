<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackMail;
use Illuminate\Http\Request;
use App\Mail\AdminFeedbackMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Tag;
use App\Models\Sighting;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
        return view("feedback", ["id"=>$id]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        // dd($request->all());
        $sighting = Sighting::find($request["id"]);//Sighting::with('tag')->find($request["id"]);
        $tag = Tag::find($sighting["tag_id"]);
        $parts=array($request["terms1"],$request["terms2"],$request["terms3"],$request["terms4"]);
        $parts=array_filter($parts);
        $sighting->success=join(", ",$parts);
        $sighting->rating=$request["feedback"];
        $sighting->feedback=$request["message"];
        $sighting->save();
        $email = $tag["email1"];
        Log::info('Sending feedback mail');

        Mail::to($email)->send(new AdminFeedbackMail($request->all()));

        return view("success", ["message"=>"Vielen Dank für das Feedback / Thanks for the feedback"]);
    }
}
