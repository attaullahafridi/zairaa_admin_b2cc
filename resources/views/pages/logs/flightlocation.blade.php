@extends('main.main')
@section('title')
Flight
@endsection
@section('content')
<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">Flight Search Logs</h5>
		
		<a href="{{route('flightdetail',[0])}}" class="btn btn-primary">Back</a>


	</div>
	
	<div class="card-header header-elements-inline">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
		<h4>Date: {{\Carbon\Carbon::parse($selected_date)->format('d-M-Y')}}</h4>
		</div>
		<div class="col-md-2">
		<a style="float: right;" href="{{route('flightlocationpdf',[$selected_date,$location])}}" class="btn btn-danger">Export PDF</a>
			
		</div>
	</div>
</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
	<table class="table datatable-scroll-y" width="100%">
		<thead>
			<tr>
				
				<th>Location</th>
				<th>Selected Flight</th>
				
				
			</tr>
		</thead>
		<tbody>
			<!-- flight -->
			@if(isset($data))
			@foreach($data as $book)
			<tr>
				<td>{{$book->to_location}}</td>
				<td>@if($book->selection=='') NONE @else {{$book->selection}} @endif</td>
			</tr>
			@endforeach
			@endif

		
			
		</tbody>
	</table>
			</div>
		</div>
	</div>

</div>


@endsection

@push('scripts')

@endpush