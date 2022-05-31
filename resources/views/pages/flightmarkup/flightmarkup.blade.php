@extends('main.main')
@section('title')
Flight Markup
@endsection
@section('content')

<div class="card">
	<div class="card-body">
		@if(isset($cat))
				{!! Form::model($cat,['route' => ['flightmarkup.update', $cat->id ], 'method' => 'put']) !!}
				@else
				{!! Form::open(['route' => ['flightmarkup.store'], 'method' => 'post']) !!}
				@endif

				@csrf
			<fieldset class="mb-3">
				<legend class="text-uppercase font-size-sm font-weight-bold">Flight Markup</legend>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Flight Name</label>
							<div class="col-lg-10">
								{!! Form::text('flight_name', null,['id'=>'','class'=>'form-control','required'=>'required']) !!}
							</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Flight Code</label>
							<div class="col-lg-10">
								{!! Form::text('flight_code', null,['id'=>'','class'=>'form-control','required'=>'required']) !!}
							</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Markup in Percentage</label>
							<div class="col-lg-10">
								{!! Form::number('amount', 'null',['id'=>'','class'=>'form-control','required'=>'required']) !!}
							</div>
					</div>

			</fieldset>
			@if(isset($cat))

			<div class="text-right">
				<a href="{{route('flightmarkup.index')}}" class="btn btn-danger text-white">Cancel</a>
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
<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title"></h5>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>SNo.</th>
				<th>Flight Name</th>
				<th>Flight Code</th>
				<th>Markup Percentage</th>
				<th class="text-center" style="width: 100px;">Action</th>
			</tr>
		</thead>
		<tbody>
			@if(isset($categ))
				@foreach($categ as $ca)
					<tr>
						<td>{{$loop->iteration}}</td>
						<td>{{$ca->flight_name}}</td>
						<td>{{$ca->flight_code}}</td>
						<td>{{$ca->amount}}</td>
						<td class="text-center">
							<a href="{{route('flightmarkup.edit',$ca->id)}}"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
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
		                            {!! Form::open(['route' => ['flightmarkup.destroy',$ca->id], 'method' => 'delete','id'=>'']) !!}
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

@if(isset($categ))
<div class="float-right">
	{{ $categ->links() }}
	</div>
@endif

@endsection

@push('scripts')

@endpush
