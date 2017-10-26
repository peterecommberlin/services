
@extends('layouts.default')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">Overview <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Reports</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Analytics</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Export</a>
            </li>
          </ul>


@endsection

@section('content')

<p>This is my body content.</p>


<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Nadawca / Sender</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Temat</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-check">
    <label for="exampleInputEmail1">Wklej adresy e-mail</label>

     <textarea type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"></textarea>

  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>



<iframe src="{{$iframeSrc}}"></iframe>

@endsection


