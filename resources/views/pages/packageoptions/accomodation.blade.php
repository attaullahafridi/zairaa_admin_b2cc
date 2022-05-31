@extends('main.main')
@section('title')
Package Accomodation
@endsection
@section('content')

<div class="card">
	<div class="card-body">
		@if(isset($cat))
				{!! Form::model($cat,['route' => ['accomodation.update', $cat->id ], 'method' => 'put', 'files' => true]) !!}
				@else
				{!! Form::open(['route' => ['accomodation.store'], 'method' => 'post', 'files' => true]) !!}
				@endif

				@csrf
			<fieldset class="mb-3">
				<legend class="text-uppercase font-size-sm font-weight-bold">Package Accomodation</legend>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Select Package</label>
						<div class="col-lg-10">
							
						
							@if(isset($cat))
							<input type="text" class="form-control" disabled="" value="{{$cat->packagename->name}}">
							@else
							{!! Form::select('pk_id',$catdd, null,['id'=>'','class'=>'form-control','placeholder'=>'','required'=>'']) !!}
							@endif

						</div>
						
					</div>

				<div class="form-group row">
						<label class="col-form-label col-lg-2">Destination</label>
						<div class="col-lg-10">
							{!! Form::text('destination', null,['id'=>'','class'=>'form-control','required'=>'required']) !!}
						</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Hotel Name</label>
						<div class="col-lg-10">
							{!! Form::text('hotel_name', null,['id'=>'','class'=>'form-control','required'=>'required']) !!}
						</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Hotel Star</label>
						<div class="col-lg-10">
							{!! Form::number('hotel_star', null,['id'=>'','class'=>'form-control','required'=>'required']) !!}
						</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Hotel Image</label>
						<div class="col-lg-2">

							{!! Form::file('image', null,['id'=>'','class'=>'form-control']) !!}
							
						</div>
						<div class="col-lg-8">
							@if(isset($cat))
							<img src="{{asset('public/images')}}/{{$cat->image}}" width="42" height="42">
							@endif
						</div>

					</div>
					
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Description</label>
						<div class="col-lg-10">
							{!! Form::textarea('description', null,['id'=>'','class'=>'form-control summernote','required'=>'required']) !!}
						</div>
					</div>
					
			</fieldset>
			@if(isset($cat))

			<div class="text-right">
				<a href="{{route('package.index')}}" class="btn btn-danger text-white">Cancel</a>
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
			<th>Package Name</th>
			<th>Destination</th>
			<th>Hotel Name</th>
			<th>Hotel Star</th>
			<th>Image</th>
			<th>Description</th>
			<th class="text-center" style="width: 100px;">Action</th>
		</tr>
	</thead>
	<tbody>
		@if(isset($categ))
		@foreach($categ as $ca)
		<tr>
			<td>{{$loop->iteration}}</td>
			<td>{{$ca->packagename->name}}</td>
			<td>{{$ca->destination}}</td>
			<td>{{$ca->hotel_name}}</td>
			<td>{{$ca->hotel_star}}</td>
			<td><a href="{{asset('public/images')}}/{{$ca->image}}" target="__blank"><img src="{{asset('public/images')}}/{{$ca->image}}" height="42" width="42"></a></td>
			<td>{!! $ca->description !!}</td>
			<td class="text-center">
				<a href="{{route('accomodation.edit',$ca->id)}}"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
				<a href="" data-toggle="modal" data-target="#delete-Mod-{{$ca->id}}">
                                            <i class="fa fa-trash fa-lg"></i></a>
				
			</td>
		</tr>

		<div class="modal fade" id="delete-Mod-{{$ca->id}}" role="dialog"
                                                 aria-labelledby="confirmDeleteLabel"
                                                 aria-hidden="true">
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
                                                            {!! Form::open(['route' => ['accomodation.destroy',$ca->id], 'method' => 'delete','id'=>'']) !!}
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
});

	function subcat(cat_id){

	$('#district').empty();
	// $('#district').attr('placeholder','Select Item Size');
	var option = '<option value=""></option>';
	$.ajax({

		    method: 'POST',
		    url: "{{ url('getsubcat') }}",
		    data: {cat_id:cat_id,_token:@json(csrf_token())},

		    success: function(data)
		    {
		        // console.log(data);

		        // $('#district').prop('disabled',false);
                    for (var i = 0; i < data.length; i++) {
                        var child_id = data[i].id;
                        var child_desc = data[i].name;

                       
                     option += "<option value='"+child_id+"'>"+child_desc+"</option>"; 
                    	$("#district").html(option);
                    
		       }

		    },
		    error: function(error)
		    {
		        console.log(error);
		    }
		});

	}
</script>
@endpush