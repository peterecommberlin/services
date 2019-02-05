<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Eventjuicer\Repositories\MeetupRepository;
use Eventjuicer\Repositories\ParticipantRepository;
use Eventjuicer\Repositories\Criteria\BelongsToParticipant;
use Eventjuicer\Repositories\Criteria\SortByDesc;

use Carbon\Carbon;

use App\Mail\Meetups\Approved;
use Illuminate\Support\Facades\Mail;

class RsvpController extends Controller
{

    protected $user;
    protected $meetups;
    protected $participants;

    function __construct(
        ParticipantRepository $participants, 
        MeetupRepository $meetups) {

        $this->participants = $participants;
        $this->meetups = $meetups;

        $this->middleware(function($request, $next)
        {

            $token = trim( $request->input("token", "") );

            if($token)
            {
                $request->session()->put("token", $token);
            }

            $response = $next($request);

            return $response;
        });

    }



    function index(Request $request)
    {

        // if(){
        //     app()->setLocale("en");
        //     config(["app.name" => "E-commerce Berlin Expo"]);
        // }
        
        //remove token from URL for security purposes...
        if($request->input("token", false))
        {
            return redirect()->action("RsvpController@index");
        }

        $this->restoreUserFromSession();

        if(!$this->user){
            abort(404);
        }

        $this->meetups->pushCriteria(
            new BelongsToParticipant($this->user->id)
        );

        $this->meetups->pushCriteria(
            new SortByDesc("created_at")
        );

        $meetups = $this->meetups->with(
            ["admin.fields", "company.data"]
        )->all();

        return view("rsvp.index", [
            "meetups" => $meetups
        ]);

    }


    function approve($id)
    {
    	if($this->updateStatus($id, true))
        {

            return redirect()->action("RsvpController@index")->withStatus("Thanks! We will notify an exhbitor!");
        }

        return redirect()->action("RsvpController@index")->withError("Cannot access!");
    	 
    }

    function reject($id)
    {
       if($this->updateStatus($id))
        {
            return redirect()->action("RsvpController@index")->withStatus("Roger that!");
        }

        return redirect()->action("RsvpController@index")->withError("Cannot access!");
    }



    function updateStatus($id, $approve = false)
    {
         $this->restoreUserFromSession();

         $meetup = $this->meetups->find($id);

         if($meetup->participant_id != $this->user->id)
         {
            return false;
         }

         //already responded!
         if($meetup->responded_at)
         {
           return false;
         }

         $this->meetups->update([

            "responded_at" => Carbon::now(),
            "agreed" => intval( $approve)

            ], $id);

         if($approve)
         {

            Mail::queue( new Approved( $meetup->fresh() ) );

         }

         return true;

    }


    function restoreUserFromSession()
    {

        $this->user = $this->participants->findBy("token", session("token"));
    }   
  

}
