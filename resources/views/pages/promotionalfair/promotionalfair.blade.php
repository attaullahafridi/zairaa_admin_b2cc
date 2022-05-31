@extends('main.main')
@section('title')
Flight Markup
@endsection
@section('css')
@endsection
@section('content')
<style>
	.ttmulti-selections{
		width: 100% !important;
	}
</style>
	<div class="card">
		<div class="card-body">
			@if(isset($cat))
				{!! Form::model($cat,['route' => ['promotionalfair.update', $cat->id ], 'method' => 'put']) !!}
			@else
				{!! Form::open(['route' => ['promotionalfair.store'], 'method' => 'post']) !!}
			@endif

			@csrf
			<fieldset class="mb-3">
				<legend class="text-uppercase font-size-sm font-weight-bold">Promotional Fair</legend>
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Flight Code <span class="text-danger"> * </span></label>
							<div class="col-lg-10">
								{!! Form::text('flight_code', null,['id'=>'','class'=>'form-control','required'=>'required','style'=>'text-transform:uppercase']) !!}
							</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Origin <span class="text-danger"> * </span></label>
							<div class="col-lg-10">
								{!! Form::text('origin_select', null,['id'=>'','class'=>'form-control typeahead typeahead_origion',''=>'']) !!}
            		<input type="hidden" name="origin" id="from_code">
							</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Destination <span class="text-danger"> * </span></label>
							<div class="col-lg-10">
								{!! Form::text('destination_select', null,['id'=>'','class'=>'form-control typeahead typeahead_destination',''=>'']) !!}
            		<input type="hidden" name="destination" id="destination_code">
							</div>
					</div>
					<!-- <div id="typeaheadmulti"> -->
					  <!-- <input class="typeahead multiple_origion" type="text" placeholder="Search Languages"> -->
            <!-- typeahead setting -->
            <!-- <input type="text" class="form-control typeahead typeahead_origion" name="from" required placeholder="From"> -->
            <!-- <input type="hidden" name="origion_code" id="from_code"> -->
					<!-- </div> -->

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Selling Date <span class="text-danger"> * </span></label>
							<div class="col-lg-10">
								{!! Form::date('selling_date', \Carbon\Carbon::now(),['id'=>'','class'=>'form-control','required'=>'required']) !!}
							</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Travel Date <span class="text-danger"> * </span></label>
							<div class="col-lg-10">
								{!! Form::date('travel_date', \Carbon\Carbon::now(),['id'=>'','class'=>'form-control','required'=>'required']) !!}
							</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Promotion Amount in Percentage <span class="text-danger"> * </span></label>
							<div class="col-lg-10">
								{!! Form::number('promotion_amount', 'null',['id'=>'','class'=>'form-control','required'=>'required']) !!}
							</div>
					</div>
			</fieldset>
			@if(isset($cat))
				<div class="text-right">
					<a href="{{route('promotionalfair.index')}}" class="btn btn-danger text-white">Cancel</a>
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
					<th>Flight Code</th>
					<th>Origin</th>
					<th>Destination</th>
					<th>Selling Date</th>
					<th>Travel Date</th>
					<th>Promotion Amount in Percentage</th>
					<th class="text-center" style="width: 100px;">Action</th>
				</tr>
			</thead>
			<tbody>
				@if(isset($categ))
					@foreach($categ as $ca)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$ca->flight_code}}</td>
							<td>{{$ca->origin}}</td>
							<td>{{$ca->destination}}</td>
							<td>{{$ca->selling_date}}</td>
							<td>{{$ca->travel_date}}</td>
							<td>{{$ca->promotion_amount}}</td>
							<td class="text-center">
								<a href="{{route('promotionalfair.edit',$ca->id)}}">
									<i class="fa fa-edit fa-lg"></i>
								</a>&nbsp;
								<a href="" data-toggle="modal" data-target="#delete-Mod-{{$ca->id}}">
				          <i class="fa fa-trash fa-lg"></i>
				        </a>
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
				            {!! Form::open(['route' => ['promotionalfair.destroy',$ca->id], 'method' => 'delete','id'=>'']) !!}
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

@push('typeahead')
  <script type="text/javascript" src="{{ asset('public/js/typeahead.bundle.js') }}"></script>
	<link href="{{asset('public/css/typeahead-multiselect.css')}}" rel="stylesheet" type="text/css">
	<script src="{{asset('public/js/typeahead-multiselect.min.js')}}"></script>
@endpush
@push('typeahead')
  @include('typeahead.flight_typehead')
@endpush

