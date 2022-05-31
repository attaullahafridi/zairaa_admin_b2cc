@extends('main.main')
@section('title')
Dashboard
@endsection
@section('content')
<div class="card">
	<div class="card-header header-elements-inline">
		<h5 class="card-title">Dashboard</h5>
		
	</div>
<!-- ///////////////////////////////////////////////////////////////// -->
<div class="container">
	<div class="row">
        <div class="col-xl-6 col-lg-6 col-12">
        	{{-- <a href="{{route('flightdetail',[0])}}"> --}}
            <a href="#">
            <div class="card bg-primary">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fa fa-plane white font-large-2 float-left" style="font-size: 50px;"></i>
                            </div>
                            <div class="media-body white text-right">
                                <h3 id="flights">0</h3>
                                <span>Today's Flight Searches</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>

        <div class="col-xl-6 col-lg-6 col-12">
        	{{-- <a href="{{route('hoteldetail',[0])}}">  --}}
            <a href="#">
            <div class="card bg-danger">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fa fa-hotel white font-large-2 float-left" style="font-size: 50px;"></i>
                            </div>
                            <div class="media-body white text-right">
                                <h3 id="hotel">0</h3>
                                <span>Today's Hotel Searches</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-xl-6 col-lg-6 col-12">
            	<a href="route('activitydetail',[0])">
            <div class="card bg-success">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fa fa-child white font-large-2 float-left" style="font-size: 50px;"></i>
                            </div>
                            <div class="media-body white text-right">
                                <h3 id="activity">0</h3>
                                <span>Today's Activity Searches</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        		</a>
        </div>

        <div class="col-xl-6 col-lg-6 col-12">
        	<a href="route('transferdetail',[0])">
            <div class="card bg-warning">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fa fa-car white font-large-2 float-left" style="font-size: 50px;"></i>
                            </div>
                            <div class="media-body white text-right">
                                <h3 id="transfer">0</h3>
                                <span>Today's Transfer Searches</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>

    </div> -->
</div>

</div>

@endsection

@push('scripts')
<script type="text/javascript">

$(document).ready(function() {
  executeQuery();
  executeQuery1();
});

function executeQuery() {
  $.ajax({
    url: "{{route('searchlogsflight')}}",
    success: function(data) {
      $("#flights").text(data);
    },
    error: function(data){
      console.log(data);
    }
  });
}

/////////////////////////////hotel/////////////////////////////////////////////
function executeQuery1() {
  $.ajax({
    url: "{{route('searchlogshotel')}}",
    success: function(data) {
      $("#hotel").text(data);
    },
    error: function(data){
      console.log(data);
    }
  });

  setTimeout(executeQuery, 60000);
  setTimeout(executeQuery1, 60000);
}

</script>
@endpush