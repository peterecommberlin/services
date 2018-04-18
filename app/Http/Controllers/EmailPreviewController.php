<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Mail\ParticipantInviteMail;
use Eventjuicer\Models\Participant;

class EmailPreviewController extends Controller
{
    

	function __construct() {

	}


	function index($name){

		$exampleParticipant = Participant::find(1);

		return ( new ParticipantInviteMail($exampleParticipant, $name, "_subject_") )->render();

	}

}
