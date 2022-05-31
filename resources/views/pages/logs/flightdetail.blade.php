@extends('main.main')
@section('title')
Flight
@endsection
@section('content')
<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">Flight Search Logs</h5>
		
		<a href="{{route('home')}}" class="btn btn-primary">Back</a>
	</div>
	
	<div class="card-header header-elements-inline">
		<div class="container">
		<form method="get" action="{{route('flightdetail',[1])}}">
			<div class="row">
				<div class="col-md-1">
					<p>Date:</p>
				</div>
				<div class="col-md-8">
					<input id="selected" class="form-control" type="text" name="selected" readonly="" value="@if(isset($date)){{$date}}@else{{\Carbon\Carbon::now()->format('m/d/Y')}}@endif" />
				</div>
				<div class="col-md-1">
				<button class="btn btn-success">Search</button>
				</div>
				<div class="col-md-1">
					<a href="#" class="btn btn-danger" onclick="flightpdf()">Export PDF</a>
				</div>
			</div>
	</form>
		</div>
	</div>

	<div class="container">
		<hr>
		<div class="row">
			<div class="col-md-12">
	<table class="table datatable-scroll-y" width="100%">
		<thead>
			<tr>
				
				<th>Location</th>
				<th>Searched</th>
				
				
			</tr>
		</thead>
		<tbody>
			<!-- hotels -->
			@if(isset($data))
			@foreach($data as $book)
			<tr>
				<td><a style="color: blue;" onclick="dest('{{$book->to_location}}')">{{$book->to_location}}</a></td>
				<td>{{$book->num_of_occ}}</td>
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
<script>
$(function() {
  $('#selected').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true
  });
});

///////////////////////////////////////////////////


function flightpdf(){
	var date = $('#selected').val();	
	window.location.href = "{{url('flightpdf')}}/"+date;
}

function dest(val){
	// alert(val);
	var date1 = $('#selected').val();	
	// alert(date1);
	window.location.href = "{{url('flightlocation')}}/"+date1+"/"+val;

}
  
</script>
@endpush