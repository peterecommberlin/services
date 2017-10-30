
@extends('layouts.default')

@section('title', 'Kreacja')

@section('content')



<form method="POST" action="{{ action("PromoCreativeController@store", ["participantId"=>$participantId]) }}">

 {{ csrf_field() }}

 <input type="hidden" name="template_id" value="{{ old('template_id') }}" />  




  <div class="form-group">
    <label for="">Nazwa</label>
    <input type="text" name="name" class="form-control" value="{{old("name")}}" />
    <small class="form-text text-muted">Ta nazwa nie będzie udostępniana.</small>
  </div>

</fieldset>



<div class="row mt-5">
  
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
     


  <h3>Edycja</h3>


  <div class="form-group">
    <label for="">Tytuł</label>
    <input type="text" name="data[title]" class="form-control" value="{{old("data.title")}}" />
  </div>


  <div class="form-group">
    <label for="">Opis</label>
    <textarea name="data[description]" class="form-control">{{old("data.description")}}</textarea>
  </div>


</div><!--col-->


<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">


  <h3>Wybierz szablon</h3>


    <div class="row">

    @foreach($templates AS $i => $template)

      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">


      <img src="{{ secure_asset("storage/". $template->path ) }}" data-id="{{ $template->id }}" class="selectable img-thumbnail" />


      </div>

    @endforeach

    </div>

</div><!--col-->


</div><!--row-->



<p>

<button type="submit" class="btn btn-primary">Dalej</button>

 <a href="{{action("PromoCreativeController@index", ["participantId" => $participantId])}}" class="btn btn-default">Powrót</a>

</p>


</form>











@endsection



@push('scripts')

<script type="text/javascript">

jQuery(function(){

  var selectable = jQuery(".selectable");
  var input = jQuery('input[name="template_id"]');
  var datasetField = "id";
  var activeClass = "btn-primary";

  if(input.val())
  {
    selectable.filter(function()
    { 
      return jQuery(this).data(datasetField) == input.val();
    }).addClass(activeClass);
  }

  selectable.bind("click", function()
  {
    var ref = jQuery(this);
    selectable.not(ref).removeClass(activeClass);
    ref.addClass(activeClass);
    input.val(ref.data(datasetField));
  });

});

</script>

@endpush




