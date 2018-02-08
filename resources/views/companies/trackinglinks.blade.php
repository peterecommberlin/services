
@extends('layouts.default')

@section('title', 'List of tracking links!')


@section('content')


@include('shared.did-you-know', ["title"=>"", "description" => ''])


 
<table class="table">
  <thead class="thead-inverse">
    <tr>
      
      <th>Company domain</th>
      <th>Stats</th>
      <th>Link</th>
    </tr>
  </thead>
  <tbody>

@foreach($data as $company)


    <tr>

      <th scope="row">
      	 {{array_get($company, "domain")}}
      </th>
      <td>
      		  
           {{array_get($company, "stats.sessions")}}
      
      	 
      
      </td>
      <td>
        
            https://ecommerceberlin.com/?utm_source=company_{{array_get($company, "company.id")}}

      </td>
    
    </tr>
  
 @endforeach


  </tbody>
</table>


@endsection


