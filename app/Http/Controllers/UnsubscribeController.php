<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Eventjuicer\Services\Hashids;
use Eventjuicer\Models\Participant;
use Eventjuicer\Repositories\ParticipantMuteRepository;
use Eventjuicer\Repositories\Criteria\ColumnMatches;
use Illuminate\Database\Eloquent\Model;
use Eventjuicer\Models\ParticipantMute;

class UnsubscribeController extends Controller
{


    /*
        bob_participant_mutes
        
        id
        email
        level
        organizer_id
        group_id
        event_id
        created_at
        updated_at

    */
	
    function __construct()
	{
    
	}

    
    //test vddqwm

    function index(Request $request, ParticipantMuteRepository $mutes, $hash)
    {

        $user = $this->getUser($hash);

        if($user){
            return view("unsubscribe.options", ["hash" => $hash]);
        }
       
        return view("unsubscribe.notfound");
	
    }


    function muteGroup(Request $request, ParticipantMuteRepository $mutes, $hash){

        $user = $this->getUser($hash);

        if($user && $this->doUnsub($user, "group")){
            return view("unsubscribe.done");
        }

        return view("unsubscribe.notfound");
    }


    function muteLocation(Request $request, ParticipantMuteRepository $mutes, $hash){

        $user = $this->getUser($hash);

        if($user && $this->doUnsub($user, "location")){
            return view("unsubscribe.done");
        }
     
        return view("unsubscribe.notfound");         
    }

    function muteEvent(Request $request, ParticipantMuteRepository $mutes, $hash){

        $user = $this->getUser($hash);

        if($user && $this->doUnsub($user, "event")){
            return view("unsubscribe.done");
        }

        return view("unsubscribe.notfound");
    }

    private function doUnsub(Model $user, $unSubType = ""){

        //we got a fuckup here....
        //event, group must be from CURRENT SCOPE!

        $event_id = 87;
        $group_id = 1;
        $organizer_id = 1;

        $mute = ParticipantMute::firstOrNew([
            "email" => $user->email, 
            "event_id" => $event_id
        ]);
        
        $mute->email = $user->email;
        $mute->level = $unSubType;
        
        //tempfix!!
        $mute->organizer_id = $organizer_id;
        $mute->group_id = $group_id;
        $mute->event_id = $event_id;

        $mute->save();

        return $mute->id;   
    }

    private function getUser($hash){

        $participant_id =  (new Hashids())->decode($hash);

        return is_numeric($participant_id) ? Participant::find($participant_id) : null;

    }

}
