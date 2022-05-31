@extends('main.main')
@section('title')
Users' Detail
@endsection
@section('content')

<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">Users' Details</h5>
	</div>
	<div class="card-body">
		<form method="POST" action="{{ route('users_detail_export') }}">
			@csrf
			<div class="row">
				<div class="col-md-4">
					<select class="form-control float-right" name="export_result">
						<option value="10">All</option>
						<option value="0">Members</option>
						<option value="2">Guests</option>
					</select>
				</div>
				<div class="col-md-3">
					<button class="btn btn-success" type="submit">Export to excel</button>
				</div>
			</div>
		</form>
		<div class="row pt-2">
			<div class="col-md-12">
				<table class="table datatable-scroll-y" width="100%">
					<thead>
						<tr>
							<th>First Name</th>				
							<th>Last Name</th>				
							<th>Contact #</th>				
							<th>Email</th>				
							<th>User Type</th>				
						</tr>
					</thead>
					<tbody>
						@isset($users_detail)
							@foreach($users_detail as $detail)
								<tr>
									<td>
										@if($detail->users_detail !== null)
											{{ $detail->users_detail->fname }}
										@endif
									</td>				
									<td>
										@if($detail->users_detail !== null)
											{{ $detail->users_detail->lname }}
										@endif
									</td>				
									<td>
										@if($detail->users_detail !== null)
											{{ $detail->users_detail->phone }}
										@endif
									</td>				
									<td>
										@if($detail->users_detail !== null)
											{{ $detail->email }}
										@endif
									</td>				
									<td>
										@if($detail->type == 0)
											Member 
										@elseif($detail->type == 2)
											Guest
										@endif
									</td>		
								</tr>
							@endforeach
						@endisset
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')

@endpush