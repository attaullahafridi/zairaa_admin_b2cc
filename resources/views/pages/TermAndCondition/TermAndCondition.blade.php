@extends('main.main')
@section('title')
	About Us
@endsection
@section('content')
<div class="card">
	<div class="card-body">
		<form action="{{ route('term_and_condition.store') }}" method="post" enctype="multipart/form-data">
			@csrf
			<fieldset class="mb-3"  style="background: #DCDCDC;">
				<h5 style="margin-top: 8px;margin-left: 8px;">Term And Condition</h5>
			</fieldset>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Text</label>
					<div class="col-lg-8">
						<textarea class="form-control summernote" col="20" rows="4" name="text">{{$TermAndCondition->text}}</textarea>
					</div>
				</div>
			</fieldset>
			<div class="row">
				<div class="col-lg-10 text-right">
					<button type="submit" class="btn btn-primary">Update<i class="icon-paperplane ml-2"></i></button>
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