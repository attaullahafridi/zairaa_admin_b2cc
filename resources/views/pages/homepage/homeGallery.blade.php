@extends('main.main')

@section('title')

    HomePage

@endsection

@section('content')

    <!-- <link href="{{asset('public/global_assets/js/plugins/forms/selects/select2.min.css')}}" rel="stylesheet" type="text/css"> -->





    <div class="card">

        <div class="card-body">

            @if(isset($dest))

                {!! Form::model($dest,['route' => ['gallery.update', $dest->id ], 'method' => 'put', 'files' => true]) !!}

            @else

                {!! Form::open(['route' => ['gallery.store'], 'method' => 'post', 'files' => true]) !!}

            @endif



            @csrf

            <fieldset class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">Footer Gallery</legend>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Image</label>
                    <div class="col-lg-2">
                        {!! Form::file('image', null,['id'=>'image','required'=>'required']) !!}
                    </div>
                    <div class="col-lg-5">
                        @if(isset($dest))
                            <img src="{{asset('public/images')}}/gallery/{{$dest->image}}" width="42" height="42">
                        @endif
                    </div>

                    {{--<div class="col-lg-3">--}}
                        {{--<p style="color: red;">Image Size: 300x180</p>--}}
                    {{--</div>--}}
                </div>


            </fieldset>

            @if(isset($dest))


                <div class="text-right">

                    <a href="{{route('topFlight.index')}}" class="btn btn-danger text-white">Cancel</a>

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

                <th width="6%">S.No</th>

                <th>Image</th>

                <th class="text-center" style="width: 100px;">Action</th>

            </tr>

            </thead>

            <tbody>

            @if(isset($gallery))

                @foreach($gallery as $des)

                    <tr>

                        <td>{{$loop->iteration}}</td>


                        <td><a href="{{asset('public/images')}}/gallery/{{$des->image}}" target="__blank"><img src="{{asset('public/images')}}/gallery/{{$des->image}}" height="42" width="42"></a></td>

                        <td class="text-center">

                            <a href="{{route('gallery.edit',$des->id)}}"><i class="fa fa-edit fa-lg"></i></a>&nbsp;

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

                                    {!! Form::open(['route' => ['gallery.destroy',$des->id], 'method' => 'delete','id'=>'']) !!}

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

@endpush