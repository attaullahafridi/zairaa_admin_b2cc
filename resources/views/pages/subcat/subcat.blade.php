@extends('main.main')
@section('title')
Sub-Category
@endsection
@section('content')

<div class="card">
	<div class="card-body">
		@if(isset($cat))
			{!! Form::model($cat,['route' => ['subcat.update', $cat->id ], 'method' => 'put', 'files' => true]) !!}
			@else
			{!! Form::open(['route' => ['subcat.store'], 'method' => 'post', 'files' => true]) !!}
			@endif

			@csrf
			<fieldset class="mb-3">
				<legend class="text-uppercase font-size-sm font-weight-bold">Sub Categories</legend>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Select Category</label>
						<div class="col-lg-10">
							{!! Form::select('cat_id',$catdd, null,['id'=>'','class'=>'form-control','placeholder'=>'','required'=>'']) !!}
						</div>
					</div>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Sub-Category Name</label>
						<div class="col-lg-10">
							{!! Form::text('name', null,['id'=>'','class'=>'form-control','required'=>'required']) !!}
						</div>
					</div>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Main Picture</label>
						<div class="col-lg-2">

							{!! Form::file('pic_main', null,['id'=>'','class'=>'form-control']) !!}
							
						</div>
						<div class="col-lg-8">
							@if(isset($cat))
							<img src="{{asset('public/images')}}/{{$cat->pic_main}}" width="42" height="42">
							@endif
						</div>

					</div>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Header Picture</label>
						<div class="col-lg-2">
							{!! Form::file('pic_header', null,['id'=>'','class'=>'form-control']) !!}
						</div>
						<div class="col-lg-8">
							@if(isset($cat))
							<img src="{{asset('public/images')}}/{{$cat->pic_header}}" width="42" height="42">
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Description</label>
						<div class="col-lg-10">
							{!! Form::textarea('description', null,['id'=>'summernote','class'=>'form-control','required'=>'required']) !!}
						</div>
					</div>
			</fieldset>
			@if(isset($cat))

			<div class="text-right">
				<a href="{{route('subcat.index')}}" class="btn btn-danger text-white">Cancel</a>
				<button type="submit" class="btn btn-primary">Update <i class="icon-paperplane ml-2"></i></button>
			</div>
			@else
			<div class="text-right">
				<button type="submit" class="btn btn-primary">Save <i class="icon-paperplane ml-2"></i></button>
			</div>
			@endif
		{!! Form::close() !!}
	</div>
</div>



<!-- table starts here -->
<div class="">
	<div class="card-header header-elements-inline">
		<h5 class="card-title"></h5>
		
	</div>
	
<table class="table datatable-basic">
	<thead>
		<tr>
			<th>SNo.</th>
			<th>Category</th>
			<th>Sub Category</th>
			<th>Main Picture</th>
			<th>Header Picture</th>
			<th>Description</th>
			<th class="text-center" style="width: 100px;">Action</th>
		</tr>
	</thead>
	<tbody>
		@if(isset($categ))
			@foreach($categ as $key => $ca)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>
						@if(isset($ca->categories->name))
							{{$ca->categories->name}}
						@endif
					</td>
					<td>{{$ca->name}}</td>
					<td><a href="{{asset('public/images')}}/{{$ca->pic_main}}" target="__blank"><img src="{{asset('public/images')}}/{{$ca->pic_main}}" height="42" width="42"></a></td>
					<td><a href="{{asset('public/images')}}/{{$ca->pic_header}}" target="__blank"><img src="{{asset('public/images')}}/{{$ca->pic_header}}" height="42" width="42"></a></td>
					<td>{!! $ca->description !!}</td>
					<td class="text-center">
						<a href="{{route('subcat.edit',$ca->id)}}"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
						<a href="" data-toggle="modal" data-target="#delete-Mod-{{$ca->id}}">
		                                            <i class="fa fa-trash fa-lg"></i></a>
						
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
                      {!! Form::open(['route' => ['subcat.destroy',$ca->id], 'method' => 'delete','id'=>'']) !!}
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



<!-- table ends here -->


@endsection

@push('scripts')
<script type="text/javascript">
	$(document).ready(function() {
  $('#summernote').summernote({
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
});
</script>
@endpush