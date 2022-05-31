@extends('main.main')
@section('title')
Social Media
@endsection
@section('content')
<div class="card">
	<div class="card-body">
		<form action="{{ route('contact_us_google_map') }}" method="post">
			@csrf
			<fieldset class="mb-3"  style="background: #DCDCDC;">
				<h5 style="margin-top: 8px;margin-left: 8px;">Google Map Section</h5>
			</fieldset>
			<fieldset class="mb-3">
				<div class="form-group row">
					<label class="col-form-label col-lg-2">Google Map Link <span class="text-danger">*</span></label>
					<div class="col-lg-8">
						<textarea name="google_map_link" rows="5" cols="10" class="form-control">{{$SocialMedia->google_map_link}}</textarea>
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
		</form>
	</div>
</div>
@if(isset($Edit))
	<div class="card">
		<div class="card-body">
			{!! Form::model($Edit,['route' => ['contact_us.update', $Edit->id ], 'method' => 'put']) !!}
				@csrf
				<fieldset class="mb-3">
					<legend class="text-uppercase font-size-sm font-weight-bold">Office's Data</legend>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Office Heading</label>
						<div class="col-lg-8">
							<input type="text" name="heading" class="form-control" value="{{$Edit->heading}}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Office Address</label>
						<div class="col-lg-8">
							<textarea name="address" rows="5" cols="10" class="form-control summernote">{{$Edit->address}}</textarea>
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
			</form>
		</div>
	</div>
@else
	<div class="card">
		<div class="card-body">
			<form action="{{ route('contact_us.store') }}" method="post">
				@csrf
				<fieldset class="mb-3">
					<legend class="text-uppercase font-size-sm font-weight-bold">Office's Data</legend>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Office Heading</label>
						<div class="col-lg-8">
							<input type="text" name="heading" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Office Address</label>
						<div class="col-lg-8">
							<textarea name="address" rows="5" cols="10" class="form-control summernote"></textarea>
						</div>
					</div>
				</fieldset>
				<div class="row">
					<div class="col-lg-10 text-right">
						<button type="submit" class="btn btn-primary">Save <i class="icon-paperplane ml-2"></i></button>
					</div>
					<div class="col-lg-2">
					</div>
				</div>
			</form>
		</div>
	</div>
@endif
<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title"></h5>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>SNo.</th>
				<th>Office Heading</th>
				<th>Office Address</th>
				<th class="text-center" style="width: 100px;">Action</th>
			</tr>
		</thead>
		<tbody>
			@if(isset($ContactUs))
				@foreach($ContactUs as $ca)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $ca->heading }}</td>
					<td>{!! $ca->address !!}</td>
					<td class="text-center">
						<a href="{{route('contact_us.edit',$ca->id)}}"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
						<a href="" data-toggle="modal" data-target="#delete-Mod-{{$ca->id}}">
							<i class="fa fa-trash fa-lg"></i>
						</a>
					</td>
				</tr>
				<div class="modal fade" id="delete-Mod-{{$ca->id}}" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
	                <div class="modal-dialog">
	                    <div class="modal-content">
	                        <div class="modal-header">
	                            <h4 class="modal-title">Delete </h4>
	                            <button type="button" class="close" data-dismiss="modal"
	                                    aria-hidden="true">&times;
	                            </button>
	                        </div>
	                        <div class="modal-body" style="height: 75px">
	                            <p>Are you sure about this ?</p>
	                        </div>
	                        <div class="modal-footer">
	                            <button type="button" class="btn btn-default"
	                                    data-dismiss="modal">Cancel
	                            </button>
	                            {!! Form::open(['route' => ['contact_us.destroy',$ca->id], 'method' => 'delete','id'=>'']) !!}
	                            {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
	                           
	                            {!! Form::close() !!}
	                        </div>
	                    </div>
	                </div>
	            </div>
				@endforeach
			@endif
		</tbody>
	</table>
	<br>
	<br>
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