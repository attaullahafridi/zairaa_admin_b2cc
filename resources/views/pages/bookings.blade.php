@extends('main.main')
@section('title')
Bookings
@endsection
@section('content')

<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">Bookings</h5>
	</div>
	<table class="table table-hover booking_table" width="100%">
		<thead>
			<tr>
				<th>Order No</th>
				<th>Refrence</th>
				<th>Customer Name</th>
				<th>Traveler Name</th>
				<th>Booking Date</th>
				<th>Price</th>
				<th>Status</th>
				<th>Ticket Status</th>
				<th>Payment Status</th>
				<th>View Voucher</th>
			</tr>
		</thead>
		<tbody>
			<!-- hotels -->
			@if(isset($data))
				@foreach($data as $book)
					<tr>
						<td width="2%">{{$book->id}}</td>
						<td width="3%">{{$book->reference}}
							<a href="#" class="edit_pnr_{{$book->id}}">Edit</a>
						</td>
						<td width="5%">
							@if($book->user_type_id==0)
								GUEST 
							@else
								@if(isset($book->user->users_detail))
									{{ $book->user->users_detail->fname.' '.$book->user->users_detail->lname }}
								@else
									Some Issue With The User Details 
								@endif
							@endif
						</td>
						<td width="20%">
							@if($book->b_type=='flight')
								@if(isset($book->flight_booking->flight_customers))
									@foreach($book->flight_booking->flight_customers as $customer_key => $customer_value)
										{{ $customer_value->fname }}
										{{ $customer_value->lname }}
										@if($book->ticket_status == 0)
											@if($customer_value->ticket_status == null)
												<a href="#" class="edit_tkt_{{$customer_value->id}}">Edit TKT</a>
												@push('scripts')
													<script>
													$(document).ready(function(){
														$(".edit_tkt_{{$customer_value->id}}").click(function(e){
															e.preventDefault();
															$('#edit_tkt_{{$customer_value->id}}').modal('show');
														});
													});
													</script>
												@endpush
												<div class="modal fade" id="edit_tkt_{{$customer_value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-lg" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title" id="exampleModalLabel"> Edit Ticket Number</h4>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<form method="post" action="{{ route('update_ticket_number')}}">
																	@csrf
																	<input type="text" class="form-control" name="ticket_number" value="{{$customer_value->ticket_number}}">
																	<input type="hidden" name="id" value="{{$customer_value->id}}">
																	<input type="hidden" name="id" value="{{$customer_value->id}}">
																	<br>
																	<div class="modal-footer">
																		<button type="submit" class="btn btn-primary">Submit</button>
																		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>
											@endif
										@endif
										<br>
									@endforeach
								@endif
							@else
								{{$book->name }} {{$book->surname }}
							@endif
						</td>
						<td>{{date('Y-m-d h:i:s', strtotime($book->b_date))}}</td>
						<td>
							@if($book->currency=='EUR')
								&euro;
							@elseif($book->currency=='USD')
								&dollar;
							@else{{$book->currency}}
							@endif 
							{{$book->price}}
						</td>
						<td>{{$book->status}}</td>
						<td>
							@if($book->ticket_status == 0)
								PENDING
							@else
								ISSUED
							@endif
						</td>
						<td>
							@if($book->payment_status == 'UNPAID')
								PENDING
							@else
								PAID
							@endif

							<a href="#" class="payment_status_{{$book->id}}">Edit</a>
							@push('scripts')
								<script>
								$(document).ready(function(){
									$(".payment_status_{{$book->id}}").click(function(e){
										e.preventDefault();
										$('#payment_status_{{$book->id}}').modal('show');
									});
								});
								</script>
							@endpush
							<div class="modal fade" id="payment_status_{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="exampleModalLabel"> Edit Payment Status</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form method="post" action="{{ route('update_paymnt_status')}}">
												@csrf
												<select class="form-control" name="payment_status">
													<option value="UNPAID" <?php if($book->payment_status == 'UNPAID'){ echo "selected";}?>>PENDING</option>
													<option value="PAID" <?php if($book->payment_status !== 'UNPAID'){ echo "selected";}?>>PAID</option>
												</select>
												<input type="hidden" name="id" value="{{$book->id}}">
												<br>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary">Submit</button>
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>

						</td>
						@if($book->b_type=='hotel' && isset($book))
							<td>
								<a href="{{$site_link.'/HotelBookingVoucher/'.$book->reference}}" target="_blank"><i class="fa fa-bed theme-account-history-type-icon"></i> &nbsp;View</a>
							</td>
						@elseif($book->b_type=='insurance' && isset($book))
							<td>
								<a href="{{$site_link.'/print_uic/'.$book->reference}}" target="_blank"><i class="fa fa-car theme-account-history-type-icon"></i> &nbsp;View</a>
							</td>
						@elseif($book->b_type=='package' && isset($book))
								<td>
									@if($book->user_type_id==0)
										<a href="{{$site_link.'/package_confirm/'.$book->b_id.'/yes'}}" target="_blank"><i class="fa fa-glass theme-account-history-type-icon"></i>&nbsp;View</a>
									@else
										<a href="{{$site_link.'/package_confirm/'.$book->b_id}}" target="_blank"><i class="fa fa-glass theme-account-history-type-icon"></i>&nbsp;View</a>
									@endif
								</td>
						@elseif($book->b_type=='flight' && isset($book))
							<td>
								@if($book->api == 'sabre')
								<a href="{{$site_link.'/flight_voucher/'.$book->id.'/sabre/admin' }}" target="_blank"><i class="fa fa-plane theme-account-history-type-icon"></i> &nbsp;View</a>
								@else
									@if($book->user_type_id==0)
										<a href="{{$site_link.'/flight_voucher/'.$book->id.'/pnr/yes'}}" target="_blank"><i class="fa fa-plane theme-account-history-type-icon"></i> &nbsp;View</a>
									@else
										<a href="{{$site_link.'/flight_voucher/'.$book->id.'/pnr/admin'}}" target="_blank"><i class="fa fa-plane theme-account-history-type-icon"></i> &nbsp;View</a>
									@endif
								@endif
							</td>
						@else
						@endif
					</tr>

					@push('scripts')
						<script>
						$(document).ready(function(){
							$(".edit_pnr_{{$book->id}}").click(function(e){
								e.preventDefault();
								$('#edit_pnr_{{$book->id}}').modal('show');
							});
						});
						</script>
					@endpush
					<div class="modal fade" id="edit_pnr_{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="exampleModalLabel"> Edit PNR</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form method="post" action="{{ route('update_pnr')}}">
										@csrf
										<input type="text" class="form-control" name="pnr" value="{{$book->reference}}">
										<input type="hidden" name="id" value="{{$book->id}}">
										<br>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary">Submit</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			@endif
		</tbody>
	</table>
</div>
	{{ $data->links() }}

@endsection

@push('scripts')
<script>
	
	$(document).ready(function(){
    var table = $('.booking_table').DataTable({
  	 "order": [[ 0, "desc" ]],
      "autoWidth": true,
      "paging": true
    });
	});
</script>

@endpush