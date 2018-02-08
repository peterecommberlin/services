
@extends('layouts.default')

@section('title', 'Exhibitors want to meet with you!')


@section('content')


@include('shared.did-you-know', ["title"=>"Hello!", "description" => 'Below find meetup requests sent by most engaged exhibitors. Choose if you would like to meet during the expo or not. Once you choose the appropriate option it cannot be changed. If you click Accept, an exhibitor will get automated email with your contact data.'])

 
<table class="table table-striped">
  <thead class="thead-inverse">
    <tr>
      
      <th>Sender</th>
      <th>Message</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

@foreach($meetups as $meetup)


    <tr>      
      <td>
      	 
      		<strong>{{array_get($meetup->data, "from_name")}}</strong><br/>
      		{{array_get($meetup->data, "from_email")}}

      </td>
      <td>
      	 <div class="col-lg-9 col-xl-7 col-md-9">
          {{ $meetup->message }}
          </div>
      </td>
      <td>

        @if($meetup->responded_at)
          
          @if($meetup->agreed)

            <span class="badge badge-success">
              
              approved

            </span>

          @else
             
             <span class="badge badge-danger">
              
              rejected

            </span>

          @endif

        @else



        <div style="white-space: nowrap;">
          <a href="{{ action("RsvpController@approve", ["id" => $meetup->id]) }}" class="btn btn-success">Accept</a>
        <a href="{{ action("RsvpController@reject", ["id" => $meetup->id]) }}" class="btn btn-danger">Reject</a>
        </div>

        @endif

      </td>
    </tr>
  
 @endforeach


  </tbody>
</table>


@endsection


