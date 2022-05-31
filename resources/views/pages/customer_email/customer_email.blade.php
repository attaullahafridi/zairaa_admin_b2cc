@extends('main.main')
@section('title')
Recived Email Detail
@endsection
@section('content')
<!-- table starts here -->
<div class="">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">Recived Email Detail</h5>
	</div>
	
<table class="table datatable-basic">
	<thead>
		<tr>
			<th>SNo.</th>
			<th>Name</th>
			<th>Email</th>
			<th>Contact</th>
			<th>Subject</th>
			<th>Message</th>
		</tr>
	</thead>
	<tbody>
		@if(isset($send_email))
			@foreach($send_email as $email_details)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>{{$email_details->name}}</td>
					<td>{{$email_details->email}}</td>
					<td>{{$email_details->phone}}</td>
					<td>{{$email_details->subject}}</td>
					<td>{{$email_details->message}}</td>
				</tr>
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