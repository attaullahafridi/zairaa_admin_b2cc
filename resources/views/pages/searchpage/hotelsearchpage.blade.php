@extends('main.main')
@section('title')
SearchPage
@endsection
@section('content')



<div class="card">
	<div class="card-body">
		@if(isset($cat))
				{!! Form::model($cat,['route' => ['hotelsearchpage.update', $cat->id ], 'method' => 'put', 'files' => true]) !!}
				@else
				{!! Form::open(['route' => ['hotelsearchpage.store'], 'method' => 'post', 'files' => true]) !!}
				@endif

				@csrf
			<fieldset class="mb-3">
				<legend class="text-uppercase font-size-sm font-weight-bold">Hotel Search Page</legend>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Heading Image</label>
						<div class="col-lg-2">

							{!! Form::file('search_image', null,['id'=>'','class'=>'form-control','required'=>'']) !!}
							
						</div>
						<div class="col-lg-5">
							@if(isset($cat))
							<img src="{{asset('public/images')}}/{{$cat->search_image}}" width="42" height="42">
							@endif
						</div>
						<div class="col-lg-3">
							<p style="color: red;">Image Size: 1500x400</p>
						</div>

					</div>
					

					

					
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Ad Banner 1</label>
						<div class="col-lg-2">

							{!! Form::file('ad_banner_1', null,['id'=>'','class'=>'form-control','required'=>'']) !!}
							
						</div>
						<div class="col-lg-5">
							@if(isset($cat))
							<img src="{{asset('public/images')}}/{{$cat->ad_banner_1}}" width="42" height="42">
							@endif
						</div>
						<div class="col-lg-3">
							<p style="color: red;">Image Size: 320x1280</p>
						</div>

					</div>

					<div class="form-group row">
						<label class="col-form-label col-lg-2">Ad Banner 2</label>
						<div class="col-lg-2">

							{!! Form::file('ad_banner_2', null,['id'=>'','class'=>'form-control','required'=>'']) !!}
							
						</div>
						<div class="col-lg-5">
							@if(isset($cat))
							<img src="{{asset('public/images')}}/{{$cat->ad_banner_1}}" width="42" height="42">
							@endif
						</div>
						<div class="col-lg-3">
							<p style="color: red;">Image Size: 300x600</p>
						</div>

					</div>

					
					
					
			</fieldset>
			@if(isset($cat))

			<div class="text-right">
				<a href="{{route('hotelsearchpage.index')}}" class="btn btn-danger text-white">Cancel</a>
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
			<th>Header Image</th>
			<th>Ad Banner 1</th>
			<th>Ad Banner 2</th>
			
			
			<th class="text-center" style="width: 100px;">Action</th>
		</tr>
	</thead>
	<tbody>
		@if(isset($categ))
		@foreach($categ as $ca)
		<tr>
			<td>{{$loop->iteration}}</td>

			<td><a href="{{asset('public/images')}}/{{$ca->search_image}}" target="__blank"><img src="{{asset('public/images')}}/{{$ca->search_image}}" height="42" width="42"></a></td>
			
			<td><a href="{{asset('public/images')}}/{{$ca->ad_banner_1}}" target="__blank"><img src="{{asset('public/images')}}/{{$ca->ad_banner_1}}" height="42" width="42"></a></td>

			<td><a href="{{asset('public/images')}}/{{$ca->ad_banner_2}}" target="__blank"><img src="{{asset('public/images')}}/{{$ca->ad_banner_2}}" height="42" width="42"></a></td>




			<td class="text-center">
				<a href="{{route('hotelsearchpage.edit',$ca->id)}}"><i class="fa fa-edit fa-lg"></i></a>&nbsp;
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
                                                            {!! Form::open(['route' => ['hotelsearchpage.destroy',$ca->id], 'method' => 'delete','id'=>'']) !!}
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

<!-- table ends here -->



@endsection

@push('scripts')

@endpush