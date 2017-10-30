<div class="alert alert-danger">

  <div class="row align-items-center">

    <div class="col">


    <h4 class="alert-heading">
      <i class="fa fa-warning" aria-hidden="true"></i>

      {{$title}}

    </h4>
    <p>{{$description}}</p>

    </div><!--col-->

    @if(!empty($action))

    <div class="col text-right">

      <a href="{{$action}}" class="btn btn-primary btn-lg">Utwórz nową</a>

    </div>

    @endif

  </div><!--row-->

</div><!--alert-->