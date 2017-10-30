



@extends('layouts.default')




@section('title', "Kreacja: $item->name")


@section('content')



@include('shared.did-you-know', ["title"=>"", "description"=>"" ])



<div class="row mt-5">

	<div class="col-xl-7 col-lg-7 col-md-6 col-sm-6 col-12">

		<section>

			<h3 class="mb-3">LinkedIn</h3>

			<p><a href="{{ $linkedin }}" target="_blank" class="btn btn-primary">
			  <i class="fa fa-linkedin"></i> Udostępnij na LinkedIn
			</a></p>

			<div class="form-group">

			<label for="">Link do wysłania via Email, komunikator</label>

			<textarea onClick="this.select()" name="data[description]" class="form-control">{{ $linkedin }}</textarea>

			</div>

		</section>

		<hr/>

		<section class="mt-5">

			<h3 class="mb-3">Facebook</h3>

			<p><a href="{{ $facebook }}" target="_blank" class="btn btn-primary">
			  <i class="fa fa-facebook"></i> Udostępnij na Facebook
			</a></p>


			<div class="form-group">

			<label for="">Link do wysłania via email, komunikator</label>

			<textarea onClick="this.select()" name="data[description]" class="form-control">{{ $facebook }}</textarea>

			</div>



		</section>


		<hr/>


		<section class="mt-5">

			<h3 class="mb-3">Twitter</h3>

			<p><a href="{{$twitter}}" target="_blank" class="btn btn-primary">
			  <i class="fa fa-twitter"></i> Udostępnij na Twitter
			</a></p>


			<div class="form-group">

			<label for="">Link do wysłania via email, komunikator</label>

			<textarea onClick="this.select()" name="data[description]" class="form-control">{{ $twitter }}</textarea>

			</div>



		</section>

		<hr/>

		<section class="mt-5">

			<h3 class="mb-3">Inne</h3>


			<p><a id="rawDownloadBtn" href="" target="_blank" class="btn btn-primary">
			  Pobierz samą grafikę
			</a></p>


			<div class="form-group">

			<label for="">Link do wysłania via email, komunikator</label>

			<textarea onClick="this.select()" name="data[description]" class="form-control">{{ $link }}</textarea>

			</div>



		</section>





		

	</div><!--col-->

	<div class="col-xl-4 col-lg-5 col-md-6 col-sm-6 col-12">

		<div class="card mt-5">

		<div id="targetContainer">
		<div class="m-5 p-5">

		<div class="progress">

		<div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">50%</div>
		</div>
		</div>
		</div><!--target-->


		<div class="card-body">
			<h4 class="card-title">{{ array_get( $item->data, "title") }}</h4>
			<p class="card-text">{{ array_get( $item->data, "description") }}</p>
		</div>

		</div><!--card-->


	</div><!--col-->


</div><!--row-->




@endsection






@push('scripts')

<script type="text/javascript">

jQuery(function(){


  var targetContainer = jQuery("#targetContainer");
  var targetTemplate = jQuery('<img class="card-img-top" src="" alt="banner" />');
  var targetButton = jQuery("#rawDownloadBtn");

  var imageGenerateUrl = "{{$imageGenerateUrl}}";

  axios.get(imageGenerateUrl).then(function (response)
  {
  	targetTemplate.attr("src", response.data);
    targetContainer.html(targetTemplate);

    targetButton.attr("href", response.data);

  }).catch(function (error)
  {
    console.log(error);
  });

  


});

</script>

@endpush

