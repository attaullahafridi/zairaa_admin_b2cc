@extends('main.main')
@section('title')
Social Media
@endsection
@section('content')
<div class="card">
	<div class="card-body">
		<form action="{{ route('social_media.store') }}" method="post" enctype="multipart/form-data">
			@csrf
			<fieldset class="mb-3">
				<div class="form-group row">
					<label class="col-form-label col-lg-2">New Site Logo <span class="text-danger">250 x 100</span></label>
					<div class="col-lg-8">
						<input type="file" name="site_logo" value="{{$SocialMedia->logo}}" class="form-control">
					</div>
				</div>
				@if($SocialMedia->logo != null)
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Previouse Site Logo</label>
						<div class="col-lg-8">
							<a href="{{asset('public/app/'.$SocialMedia->logo)}}" target="_blank">
								<img src="{{asset('public/app/'.$SocialMedia->logo)}}" style="width: 250px; height: 100px;">
							</a>
						</div>
					</div>
				@endif
				<div class="form-group row">
					<label class="col-form-label col-lg-2">New Site FavIcon <span class="text-danger">16 x 16</span></label>
					<div class="col-lg-8">
						<input type="file" name="site_fav_icon" value="{{$SocialMedia->fav_icon}}" class="form-control">
					</div>
				</div>
				@if($SocialMedia->fav_icon != null)
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Previouse Site FavIcon</label>
						<div class="col-lg-8">
							<a href="{{asset('public/app/'.$SocialMedia->fav_icon)}}" target="_blank">
								<img src="{{asset('public/app/'.$SocialMedia->fav_icon)}}" style="width: 70px; height: 70px;">
							</a>
						</div>
					</div>
				@endif
				<div class="form-group row">
					<label class="col-form-label col-lg-2">New Site Pre Loader <span class="text-danger">200 x 200</span></label>
					<div class="col-lg-8">
						<input type="file" name="preloader" value="{{$SocialMedia->preloader}}" class="form-control">
					</div>
				</div>
				@if($SocialMedia->preloader != null)
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Previouse Site Pre Loader</label>
						<div class="col-lg-8">
							<a href="{{asset('public/app/'.$SocialMedia->preloader)}}" target="_blank">
								<img src="{{asset('public/app/'.$SocialMedia->preloader)}}" style="width: 200px; height: 200px;">
							</a>
						</div>
					</div>
				@endif
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Facebook</label>
					<div class="col-lg-8">
						<input type="text" name="facebook" value="{{$SocialMedia->facebook}}" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Youtube</label>
					<div class="col-lg-8">
						<input type="text" name="youtube" value="{{$SocialMedia->youtube}}" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Twitter</label>
					<div class="col-lg-8">
						<input type="text" name="twitter" value="{{$SocialMedia->twitter}}" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Instagram</label>
					<div class="col-lg-8">
						<input type="text" name="instagram" value="{{$SocialMedia->instagram}}" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Linkdin</label>
					<div class="col-lg-8">
						<input type="text" name="linkdin" value="{{$SocialMedia->linkdin}}" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Google Plus</label>
					<div class="col-lg-8">
						<input type="text" name="googleplus" value="{{$SocialMedia->googleplus}}" class="form-control">
					</div>
				</div>
			</fieldset>
			<div class="row">
				<div class="col-lg-10 text-right">
					<button type="submit" class="btn btn-primary">Update <i class="icon-paperplane ml-2"></i></button>
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
		// if($('.amount_flight').val()==1){
		// 	$('.is_amount_flight').prop('checked', true); // Checks it
		// }
	});
</script>
@endpush