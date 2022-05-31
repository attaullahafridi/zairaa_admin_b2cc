@extends('main.main')
@section('title')
HomePage
@endsection
@section('content')



<div class="card">
	<div class="card-body">
		@if(isset($cat))
				{!! Form::model($cat,['route' => ['secretdeals.update', $cat->id ], 'method' => 'put', 'files' => true]) !!}
				@else
				{!! Form::open(['route' => ['secretdeals.store'], 'method' => 'post', 'files' => true]) !!}
				@endif

				@csrf
			<fieldset class="mb-3">
				<legend class="text-uppercase font-size-sm font-weight-bold">Secret Deals</legend>

					
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Heading</label>
						<div class="col-lg-10">
							{!! Form::text('heading', null,['id'=>'','class'=>'form-control','required'=>'required','placeholder'=>'max 50 characters','maxlength'=>'50']) !!}
						</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Description</label>
						<div class="col-lg-10">
							{!! Form::textarea('description', null,['id'=>'','class'=>'form-control','required'=>'required','placeholder'=>'max 200 characters','maxlength'=>'200']) !!}
						</div>
					</div>

					
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Deal Image</label>
						<div class="col-lg-2">

							{!! Form::file('deal_image', null,['id'=>'','class'=>'form-control']) !!}
							
						</div>
						<div class="col-lg-5">
							@if(isset($cat))
							<img src="{{asset('public/images')}}/{{$cat->deal_image}}" width="42" height="42">
							@endif
						</div>
						<div class="col-lg-3">
							<p style="color: red;">Image Size: 1500x800</p>
						</div>

					</div>
					
					
			</fieldset>
			@if(isset($cat))

			<div class="text-right">
				<a href="{{route('secretdeals.index')}}" class="btn btn-danger text-white">Cancel</a>
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
			<th>Heading</th>
			<th>Description</th>
			<th>Deal Image</th>
			
			<th class="text-center" style="width: 100px;">Action</th>
		</tr>
	</thead>
	<tbody>
		@if(isset($categ))
		@foreach($categ as $ca)
		<tr>
			<td>{{$loop->iteration}}</td>
			<td>{{$ca->heading}}</td>
			<td>{{$ca->description}}</td>
			<td><a href="{{asset('public/images')}}/{{$ca->deal_image}}" target="__blank"><img src="{{asset('public/images')}}/{{$ca->deal_image}}" height="42" width="42"></a></td>
			<td class="text-center">
				<a href="{{route('secretdeals.edit',$ca->id)}}"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
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
                                                            {!! Form::open(['route' => ['secretdeals.destroy',$ca->id], 'method' => 'delete','id'=>'']) !!}
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

@endpush