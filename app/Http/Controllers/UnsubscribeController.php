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

        $mute = new ParticipantMute;
        $mute->email = $user->email;
        $mute->level = $unSubType;
        $mute->organizer_id = $user->organizer_id;
        $mute->group_id = $user->group_id;
        $mute->event_id = $user->event_id;
        $mute->save();

        return $mute->id;   
    }

    private function getUser($hash){

        $participant_id =  (new Hashids())->decode($hash);

        return is_numeric($participant_id) ? Participant::find($participant_id) : null;

    }

}
