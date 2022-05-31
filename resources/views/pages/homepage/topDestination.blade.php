@extends('main.main')

@section('title')

HomePage

@endsection

@section('content')

<!-- <link href="{{asset('public/global_assets/js/plugins/forms/selects/select2.min.css')}}" rel="stylesheet" type="text/css"> -->





<div class="card">

	<div class="card-body">

			@if(isset($dest))

				{!! Form::model($dest,['route' => ['topDestination.update', $dest->id ], 'method' => 'put', 'files' => true]) !!}

			@else

				{!! Form::open(['route' => ['topDestination.store'], 'method' => 'post', 'files' => true]) !!}

			@endif



			@csrf

			<fieldset class="mb-3">

				<legend class="text-uppercase font-size-sm font-weight-bold">Top Destination</legend>
					<div class="form-group row">

						<label class="col-form-label col-lg-2">Title</label>

						<div class="col-lg-10">

							{!! Form::text('city_name', null,['id'=>'city_name','class'=>'form-control','required'=>'required','placeholder'=>'e.g Dubai De','maxlength'=>'25']) !!}

						</div>

					</div>

					<div class="form-group row">

						<label class="col-form-label col-lg-2">Description</label>

						<div class="col-lg-10">

							{!! Form::text('description', null,['id'=>'description','class'=>'form-control','required'=>'required','placeholder'=>'max 50 characters','maxlength'=>'50']) !!}
						</div>
					</div>

				

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Image</label>
						<div class="col-lg-2">
							{!! Form::file('image', null,['id'=>'image','required'=>'required']) !!}
						</div>
						<div class="col-lg-5">
							@if(isset($dest))
							<img src="{{asset('public/images')}}/hotels/{{$dest->image}}" width="42" height="42">
							@endif
						</div>

						<div class="col-lg-3">
							<p style="color: red;">Image Size: 300x180</p>
						</div>
					</div>



					 <div class="form-group row">

						<label class="col-form-label col-lg-2">Select Destination</label>

						<div class="col-lg-4">
							@if(isset($dest))
							<select class="form-control" id="city_combo" name="city">
								<option value="{{$dest->city_code}}">
									
									<?php $airport=explode('/',$dest->city_code); echo $airport[1]; ?>
								</option>
								
							</select>
							@else
							<select class="form-control" id="city_combo" name="city">
								<option value="">Select Ctiy</option>
								
							</select>
							@endif

						</div>

					</div> 



					<div class="add_hotel_row">

						

					</div>

					

					

			</fieldset>

			@if(isset($dest))



			<div class="text-right">

				<a href="{{route('topDestination.index')}}" class="btn btn-danger text-white">Cancel</a>

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

			<th width="6%">SNo.</th>

			<th>City Name</th>

			<th>Description</th>

			

			<th>Image</th>

			

			<th class="text-center" style="width: 100px;">Action</th>

		</tr>

	</thead>

	<tbody>

		@if(isset($topDest))

		@foreach($topDest as $des)

		<tr>

			<td>{{$loop->iteration}}</td>

			<td>{{$des->city_name}}</td>

			<td>{{$des->description}}</td>


			<td><a href="{{asset('public/images')}}/hotels/{{$des->image}}" target="__blank"><img src="{{asset('public/images')}}/hotels/{{$des->image}}" height="42" width="42"></a></td>

			<td class="text-center">

				<a href="{{route('topDestination.edit',$des->id)}}"><i class="fa fa-edit fa-lg"></i></a>&nbsp;

				<a href="" data-toggle="modal" data-target="#delete-Mod-{{$des->id}}">

                <i class="fa fa-trash fa-lg"></i></a>

				

			</td>

		</tr>



		<div class="modal fade" id="delete-Mod-{{$des->id}}" role="dialog"

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

                        {!! Form::open(['route' => ['topDestination.destroy',$des->id], 'method' => 'delete','id'=>'']) !!}

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
<!-- <script src="{{asset('public/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script> -->
<script type="text/javascript">

	$(document).ready(function(){
			function select2_common(selector,placeholder)
		{
				$(selector).select2({
						minimumInputLength:3,
						placeholder:placeholder,
						// templateResult: formatData,
						// closeOnSelect: true,
						// templateSelection: formatData,
						ajax: {
								url: "{{route('get_cities')}}",
								dataType: "json",
								delay: 200,
								data: function (params) {
										return {
										q: params.term, // search term
										page: params.page
								};
						},
						processResults: function (data) {
								console.log(data);
								return {
										results: $.map(data, function(obj) {
												if(obj.id!=0){
												// console.log(obj);
												return { id: obj.ID+'/'+obj.TEXT, text: obj.TEXT};}
												else
														{return { id: obj.ID, text: obj.TEXT}}
										})
								};

						},
						cache: true
				},
				debug:false
		});
		}


		select2_common('#city_combo ','Select Destination');


		$(document).on('click','.add_row',function(e){

			e.preventDefault();

			var row = '<div class="form-group row"><label class="col-form-label col-lg-2">Hotel</label><div class="col-lg-3"><input type="file" name="hotel_image[]" required></div><div class="col-lg-2"><input type="text" name="hotel_name[]" class="form-control" placeholder="Hotel Name" required></div><div class="col-lg-2"><input type="number" name="price[]" class="form-control" placeholder="Price per Night" required></div><div class="col-lg-2"><input type="number" name="star[]" class="form-control" placeholder="Hotel Stars" required></div><div class="col-lg-1"><button class="btn btn-danger delete_row">-</button></div></div>';

			$('.add_hotel_row').append(row);

		});

		$(document).on('click','.delete_row',function(){

			$(this).closest('.row').remove();

		});



	});



</script>

@endpush