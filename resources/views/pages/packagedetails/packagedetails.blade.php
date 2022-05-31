@extends('main.main')
@section('title')
Package Details
@endsection
@section('content')

<div class="card">
	<div class="card-body">
		@if(isset($cat))
				{!! Form::model($cat,['route' => ['packagDetails.update', $cat->id ], 'method' => 'put', 'files' => true]) !!}
				@else
				{!! Form::open(['route' => ['packagDetails.store'], 'method' => 'post', 'files' => true]) !!}
				@endif

				@csrf
			<fieldset class="mb-3">
				<legend class="text-uppercase font-size-sm font-weight-bold">Package Overview</legend>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Select Package</label>
						<div class="col-lg-10">
							
						
							@if(isset($cat))
							<input type="text" class="form-control" disabled="" value="{{$cat->packagename->name}}">
							@else
							{!! Form::select('p_id',$catdd, null,['id'=>'','class'=>'form-control','placeholder'=>'','required'=>'']) !!}
							@endif

						</div>
						
					</div>
					
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Overview</label>
						<div class="col-lg-10">
							{!! Form::textarea('overview', null,['id'=>'','class'=>'form-control summernote','required'=>'required']) !!}
						</div>
					</div>
			</fieldset>

			@if(isset($cat))

			<div class="text-right">
				<a href="{{route('packagDetails.index')}}" class="btn btn-danger text-white">Cancel</a>
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
			<th>Overview</th>
			<th class="text-center" style="width: 100px;">Action</th>
		</tr>
	</thead>
	<tbody>
		@if(isset($categ))
		@foreach($categ as $ca)
		<tr>
			<td>{{$loop->iteration}}</td>
			<td>{{$ca->packagename->name}}</td>
			<td>{!! $ca->overview !!}</td>
			<td class="text-center">
				<a href="{{route('packagDetails.edit',$ca->id)}}"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
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
                                                            {!! Form::open(['route' => ['packagDetails.destroy',$ca->id], 'method' => 'delete','id'=>'']) !!}
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