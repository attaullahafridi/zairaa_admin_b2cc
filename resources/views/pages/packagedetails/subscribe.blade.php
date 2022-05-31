@extends('main.main')
@section('title')
Package Description
@endsection
@section('content')

<div class="card">
	<div class="card-body">
			{!! Form::open(['route' => ['subscribe.store'], 'method' => 'post', 'files' => true]) !!}
			<fieldset class="mb-3">
				<legend class="text-uppercase font-size-sm font-weight-bold">Subscribe</legend>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Background color</label>
						<div class="col-lg-10">
							{{-- {!! Form::text('color', Input::old('123'),['class'=>'form-control','required'=>'required',) !!} --}}
							<input type="hidden" name="id" value="{{@
								$result->id}}">
							<input type="text" name="color" value="{{@
								$result->color}}" class="form-control">
						</div>
						
					</div>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Subscribe Images</label>
						<div class="col-lg-10">

							{!! Form::file('subsc_img', array('multiple'=>true,'class'=>'form-control')) !!}
						@if(isset($result->image))
						<img src="{{asset('public/images/'.$result->image)}}" style="width: 100px;margin-top: 5px;">
						@endif

						</div>
						<div class="col-lg-12 pt-4 text-right">
							<button type="submit" class="btn btn-primary">Save <i class="icon-paperplane ml-2"></i></button>
						 </div>
					</div>			
			</fieldset>
			{!! Form::close() !!}
	</div>
</div>



<!-- table starts here -->
<div class="">
	<div class="card-header header-elements-inline">
		<h5 class="card-title"></h5>
		
	</div>
<div class="card-body">

	
</div>
</div>



<!-- table ends here -->


@endsection
