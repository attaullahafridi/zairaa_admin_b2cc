@extends('main.main')
@section('title')
Markup
@endsection
@section('content')
<div class="card">
	<div class="card-body">
		
				<form action="{{ route('markup.store') }}" method="post">
				
				@csrf
			


<fieldset class="mb-3">
				<legend class="text-uppercase font-size-sm font-weight-bold">{{$categ[1]->type}}</legend>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">ROE (Rate of Exchange)</label>
							<div class="col-lg-8">
								<input type="number" name="rateOfExchange" class="form-control" value="{{$roe}}">
							</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Hotel Markup Percentage</label>
							<div class="col-lg-8">
								<input type="number" name="hotelMarkup" value="{{$categ[1]->percentage}}" class="form-control">
							</div>
							
					</div>

			</fieldset>



		<!-- 	<fieldset class="mb-3">
				<legend class="text-uppercase font-size-sm font-weight-bold">{{$categ[2]->type}}</legend>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Amount</label>
							<div class="col-lg-8">
								
								
								<input type="number" name="amount[]" class="form-control" value="{{$categ[2]->amount}}">

								<input type="hidden" name="type[]" value="{{$categ[2]->type}}">
							</div>
							<div class="col-lg-2">
								<input type="checkbox" class="is_amount_{{$categ[2]->type}}" checked>

								<input type="hidden" name="is_amount[]" class="amount_{{$categ[2]->type}}" value="{{$categ[2]->is_amount}}">
							</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Percentage</label>
							<div class="col-lg-8">
								
								<input type="number" name="percentage[]" value="{{$categ[2]->percentage}}" class="form-control">
							</div>
							<div class="col-lg-2">
								<input type="checkbox" class="is_percentage_{{$categ[2]->type}}" checked>
								
								<input type="hidden" name="is_percentage[]" value="{{$categ[2]->is_percentage}}" class="percentage_{{$categ[2]->type}}">
							</div>
					</div>

			</fieldset> -->



			
	

			

			<div class="text-center">
				<button type="submit" class="btn btn-primary">Update <i class="icon-paperplane ml-2"></i></button>
			</div>
			
		{!! Form::close() !!}
	</div>
</div>


@endsection

@push('scripts')
<script type="text/javascript">
/////////////////////////////////////////////////////////////////
$(document).ready(function() {

// if($('.amount_flight').val()==1){
// 	$('.is_amount_flight').prop('checked', true); // Checks it
// }
});








</script>
@endpush