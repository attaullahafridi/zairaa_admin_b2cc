@extends('main.main')
@section('title')
	About Us
@endsection
@section('content')
<div class="card">
	<div class="card-body">
		<form action="{{ route('about_us.store') }}" method="post" enctype="multipart/form-data">
			@csrf
			<fieldset class="mb-3"  style="background: #DCDCDC;">
				<h5 style="margin-top: 8px;margin-left: 8px;">First Section</h5>
			</fieldset>
			<fieldset class="mb-3">
				<div class="form-group row">
					<label class="col-form-label col-lg-2">New First Section Image <span class="text-danger">720 x 390</span> </label>
					<div class="col-lg-8">
						<input type="file" name="first_image" class="form-control">
					</div>
				</div>
				@if($AboutUs->first_image != null)
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Previouse First Section Image </label>
						<div class="col-lg-8">
							<a href="{{asset('public/app/'.$AboutUs->first_image)}}" target="_blank">
								<img src="{{asset('public/app/'.$AboutUs->first_image)}}" style="width: 520px; height: 190px;">
							</a>
						</div>
					</div>
				@endif
				<div class="form-group row">
					<label class="col-form-label col-lg-2">First Section Heading </label>
					<div class="col-lg-8">
						<textarea class="form-control" name="first_heading">{{$AboutUs->first_heading}}</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">First Section Sub Heading </label>
					<div class="col-lg-8">
						<textarea class="form-control" name="first_sub_heading">{{$AboutUs->first_sub_heading}}</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">First Section Paragraph </label>
					<div class="col-lg-8">
						<textarea class="form-control summernote" col="20" rows="4" name="first_paragraph">{{$AboutUs->first_paragraph}}</textarea>
					</div>
				</div>
			</fieldset>
			<fieldset class="mb-3"  style="background: #DCDCDC;">
				<h5 style="margin-top: 8px;margin-left: 8px;">Second Section</h5>
			</fieldset>
			<fieldset class="mb-3">
				<div class="form-group row">
					<label class="col-form-label col-lg-2">New Second Section Image <span class="text-danger">720 x 390</span> </label>
					<div class="col-lg-8">
						<input type="file" name="second_image" class="form-control">
					</div>
				</div>
				@if($AboutUs->second_image != null)
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Previouse Second Section Image </label>
						<div class="col-lg-8">
							<a href="{{asset('public/app/'.$AboutUs->second_image)}}" target="_blank">
								<img src="{{asset('public/app/'.$AboutUs->second_image)}}" style="width: 520px; height: 190px;">
							</a>
						</div>
					</div>
				@endif
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Second Section Heading </label>
					<div class="col-lg-8">
						<textarea class="form-control" name="second_heading">{{$AboutUs->second_heading}}</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Second Section Sub Heading </label>
					<div class="col-lg-8">
						<textarea class="form-control" name="second_sub_heading">{{$AboutUs->second_sub_heading}}</textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Second Section Paragraph </label>
					<div class="col-lg-8">
						<textarea class="form-control summernote" col="20" rows="4" name="second_paragraph">{{$AboutUs->second_paragraph}}</textarea>
					</div>
				</div>
			</fieldset>
			<div class="row">
				<div class="col-lg-10 text-right">
					<button type="submit" class="btn btn-primary">Update First & Second Section <i class="icon-paperplane ml-2"></i></button>
				</div>
				<div class="col-lg-2">
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>
<div class="card">
	<div class="card-body">
			<fieldset class="mb-3"  style="background: #DCDCDC;">
				<h5 style="margin-top: 8px;margin-left: 8px;">Third Section</h5>
			</fieldset>
				@if(!$PartnersLogos->isEmpty())
					<div class="row">
						<div class="col-lg-12"><p>Previouse Logos</p></div>
						@foreach($PartnersLogos as $key => $value)
							<div class="col-lg-2">
								<a href="{{asset('public/app/'.$value->logo)}}" target="_blank">
									<img src="{{asset('public/app/'.$value->logo)}}" style=" width: 200px; height: 150px; position: relative; display: inline-block; overflow: hidden; margin: 0;border: 1px solid whitesmoke;">
								</a>
								<form action="{{ route('about_us_partners_destory') }}" method="post" enctype="multipart/form-data">
									@csrf
									<input type="hidden" name="id" value="{{ $value->id }}"> 
									<button type="submit" onclick="conform('Are You Sure You Want To Delete This Record.')" class="btn btn-danger text-center" style="margin-bottom: 5px !important;"><i class="fa fa-trash"></i></button>
								{!! Form::close() !!}
							</div>
						@endforeach
					</div>
					<br>
				@endif
		<form action="{{ route('about_us_partners') }}" method="post" enctype="multipart/form-data">
			@csrf
			<fieldset class="mb-3">
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Partners Logo <span class="text-danger">255 x 20</span> </label>
					<div class="col-lg-8">
						<input type="file" name="partner_logos" class="form-control">
					</div>
					{{--<div class="col-lg-1">
						<button type="button" class="btn btnclr btn-sm add_logos">+</button>
					</div>--}}
				</div>
        <div class="append_row"></div>
			</fieldset>
			<div class="row">
				<div class="col-lg-10 text-right">
					<button type="submit" class="btn btn-primary">Save <i class="icon-paperplane ml-2"></i></button>
				</div>
				<div class="col-lg-2">
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>


@endsection

@push('scripts')
<script type="text/javascript">
	/////////////////////////////////////////////////////////////////
	$(document).ready(function() {
    $(document).on('click','.add_logos', function(){
      var logos = '<div class="form-group row"><label class="col-form-label col-lg-2">Our Partners <span class="text-danger">720 x 390</span> </label><div class="col-lg-7"><input type="file" name="partner_logos[]" class="form-control"></div><div class="col-lg-1"><button type="button" class="btn btn-danger btn-sm remove_logos">X</button></div></div></div>';

      $(".append_row").append(logos);
    });

    $(document).on('click','.remove_logos',function(){
      var rowToDelete = $(this).closest('.row');
      rowToDelete.remove();
    });
	$('.summernote').summernote({
		followingToolbar: false,
	    toolbar: [
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']]
		]
	});

		// if($('.amount_flight').val()==1){
		// 	$('.is_amount_flight').prop('checked', true); // Checks it
		// }
	});
</script>
@endpush