<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use PDF;

class logsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function searchlogsflight(){

    	$data = DB::table('search_logs')
                ->where('type','Flight')
                ->whereDate('search_date',Carbon::today()->toDateString())
                ->count();

    	return $data;

    }

    public function searchlogshotel(){

        $data = DB::table('search_logs')
                ->where('type','Hotel')
                ->whereDate('search_date',Carbon::today()->toDateString())
                ->count();

    	return $data;

    }

    public function searchlogstransfer(){

    	$data = searchlogs::where('type','transfer')->whereDate('search_date',Carbon::now()->format('Y-m-d'))->get();

    	return $data;

    }

    public function searchlogsactivity(){

    	$data = searchlogs::where('type','activity')->whereDate('search_date',Carbon::now()->format('Y-m-d'))->get();

    	return $data;

    }
////////////////////////////////flights///////////////////////////////////////////////
    public function flightdetail($searchdate){
    	if($searchdate==0){
    	$data = searchlogs::select(DB::raw('count(*) as num_of_occ,to_location'))
                     ->where('type', 'flight')
                     ->whereDate('search_date', Carbon::now()->format('Y-m-d'))
                     ->groupBy('to_location')
                     ->get();

                     // dd($data);
    	return view('pages.logs.flightdetail',compact('data'));
    }

else{

	// dd($_GET['selected']);
	$date = $_GET['selected'];
	$selected_date = Carbon::parse($date)->format('Y-m-d');
	// dd($selected_date);
	$data = searchlogs::select(DB::raw('count(*) as num_of_occ,to_location'))
                     ->where('type', 'flight')
                     ->whereDate('search_date', $selected_date)
                     ->groupBy('to_location')
                     ->get();

                     // dd($data);
    	return view('pages.logs.flightdetail',compact('data','date'));
}
    }

    public function flightpdf($month,$date,$year){

    	// return $_GET['date'];
    	$selected_date1 = $month.'/'.$date.'/'.$year; 
    	$selected_date = Carbon::parse($selected_date1)->format('Y-m-d');
    	// dd($selected_date);
    	$data = searchlogs::select(DB::raw('count(*) as num_of_occ,to_location'))
                     ->where('type', 'flight')
                     ->whereDate('search_date', $selected_date)
                     ->groupBy('to_location')
                     ->get();
                     // dd($data);
    	$pdf = PDF::loadView('pages.logs.flightpdf',compact('data','selected_date1'));
            return $pdf->stream('Flight'.$selected_date.'.pdf');
    	// dd($selected_date);
    }

    public function flightlocation($month,$date,$year,$location){
    	// dd($location);
    	$selected_date1 = $month.'/'.$date.'/'.$year; 
    	$selected_date = Carbon::parse($selected_date1)->format('Y-m-d');
    	// dd($selected_date);
    	$data = searchlogs::where('type','flight')->where('to_location', 'like', '%' . $location . '%')->whereDate('search_date', $selected_date)->get();

    	// dd($data);
    	return view('pages.logs.flightlocation',compact('data','selected_date','location'));


    }

    public function flightlocationpdf($date,$location){

    	// dd($date);
    	$selected_date = Carbon::parse($date)->format('Y-m-d');
    	// dd($selected_date);
    	$data = searchlogs::where('type','flight')->where('to_location', 'like', '%' . $location . '%')->whereDate('search_date', $selected_date)->get();

    	$pdf = PDF::loadView('pages.logs.flightlocationpdf',compact('data','selected_date'));
            return $pdf->stream('Flight_location'.$selected_date.'.pdf');
    }
////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////hotel////////////////////////////////////////////////////////
        public function hoteldetail($searchdate){
    	if($searchdate==0){
    	$data = searchlogs::select(DB::raw('count(*) as num_of_occ,to_location'))
                     ->where('type', 'hotel')
                     ->whereDate('search_date', Carbon::now()->format('Y-m-d'))
                     ->groupBy('to_location')
                     ->get();

                     // dd($data);
    	return view('pages.logs.hotel.hoteldetail',compact('data'));
    }

else{

	// dd($_GET['selected']);
	$date = $_GET['selected'];
	$selected_date = Carbon::parse($date)->format('Y-m-d');
	// dd($selected_date);
	$data = searchlogs::select(DB::raw('count(*) as num_of_occ,to_location'))
                     ->where('type', 'hotel')
                     ->whereDate('search_date', $selected_date)
                     ->groupBy('to_location')
                     ->get();

                     // dd($data);
    	return view('pages.logs.hotel.hoteldetail',compact('data','date'));
}
    }

    public function hotelpdf($month,$date,$year){

    	// return $_GET['date'];
    	$selected_date1 = $month.'/'.$date.'/'.$year; 
    	$selected_date = Carbon::parse($selected_date1)->format('Y-m-d');
    	// dd($selected_date);
    	$data = searchlogs::select(DB::raw('count(*) as num_of_occ,to_location'))
                     ->where('type', 'hotel')
                     ->whereDate('search_date', $selected_date)
                     ->groupBy('to_location')
                     ->get();
                     // dd($data);
    	$pdf = PDF::loadView('pages.logs.hotel.hotelpdf',compact('data','selected_date1'));
            return $pdf->stream('Hotel'.$selected_date.'.pdf');
    	// dd($selected_date);
    }

    public function hotellocation($month,$date,$year,$location){
    	// dd($location);
    	$selected_date1 = $month.'/'.$date.'/'.$year; 
    	$selected_date = Carbon::parse($selected_date1)->format('Y-m-d');
    	// dd($selected_date);
    	$data = searchlogs::where('type','hotel')->where('to_location', 'like', '%' . $location . '%')->whereDate('search_date', $selected_date)->get();

    	// dd($data);
    	return view('pages.logs.hotel.hotellocation',compact('data','selected_date','location'));


    }

    public function hotellocationpdf($date,$location){

    	// dd($date);
    	$selected_date = Carbon::parse($date)->format('Y-m-d');
    	// dd($selected_date);
    	$data = searchlogs::where('type','hotel')->where('to_location', 'like', '%' . $location . '%')->whereDate('search_date', $selected_date)->get();

    	$pdf = PDF::loadView('pages.logs.hotel.hotellocationpdf',compact('data','selected_date'));
            return $pdf->stream('hotel_location'.$selected_date.'.pdf');
    }
/////////////////////////////////////////////////////////////////////////////////////
    
//////////////////////activity////////////////////////////////////////////////////////
        public function activitydetail($searchdate){
        if($searchdate==0){
        $data = searchlogs::select(DB::raw('count(*) as num_of_occ,to_location'))
                     ->where('type', 'activity')
                     ->whereDate('search_date', Carbon::now()->format('Y-m-d'))
                     ->groupBy('to_location')
                     ->get();

                     // dd($data);
        return view('pages.logs.activity.actdetail',compact('data'));
    }

else{

    // dd($_GET['selected']);
    $date = $_GET['selected'];
    $selected_date = Carbon::parse($date)->format('Y-m-d');
    // dd($selected_date);
    $data = searchlogs::select(DB::raw('count(*) as num_of_occ,to_location'))
                     ->where('type', 'activity')
                     ->whereDate('search_date', $selected_date)
                     ->groupBy('to_location')
                     ->get();

                     // dd($data);
        return view('pages.logs.activity.actdetail',compact('data','date'));
}
    }

    public function activitypdf($month,$date,$year){

        // return $_GET['date'];
        $selected_date1 = $month.'/'.$date.'/'.$year; 
        $selected_date = Carbon::parse($selected_date1)->format('Y-m-d');
        // dd($selected_date);
        $data = searchlogs::select(DB::raw('count(*) as num_of_occ,to_location'))
                     ->where('type', 'activity')
                     ->whereDate('search_date', $selected_date)
                     ->groupBy('to_location')
                     ->get();
                     // dd($data);
        $pdf = PDF::loadView('pages.logs.activity.actpdf',compact('data','selected_date1'));
            return $pdf->stream('activity'.$selected_date.'.pdf');
        // dd($selected_date);
    }

    public function activitylocation($month,$date,$year,$location){
        // dd($location);
        $selected_date1 = $month.'/'.$date.'/'.$year; 
        $selected_date = Carbon::parse($selected_date1)->format('Y-m-d');
        // dd($selected_date);
        $data = searchlogs::where('type','activity')->where('to_location', 'like', '%' . $location . '%')->whereDate('search_date', $selected_date)->get();

        // dd($data);
        return view('pages.logs.activity.actlocation',compact('data','selected_date','location'));


    }

    public function activitylocationpdf($date,$location){

        // dd($date);
        $selected_date = Carbon::parse($date)->format('Y-m-d');
        // dd($selected_date);
        $data = searchlogs::where('type','activity')->where('to_location', 'like', '%' . $location . '%')->whereDate('search_date', $selected_date)->get();

        $pdf = PDF::loadView('pages.logs.activity.actlocationpdf',compact('data','selected_date'));
            return $pdf->stream('activity_location'.$selected_date.'.pdf');
    }
/////////////////////////////////////////////////////////////////////////////////////

/////////////////////transfer////////////////////////////////////////////////////////
        public function transferdetail($searchdate){
        if($searchdate==0){
        $data = searchlogs::select(DB::raw('count(*) as num_of_occ,to_location'))
                     ->where('type', 'transfer')
                     ->whereDate('search_date', Carbon::now()->format('Y-m-d'))
                     ->groupBy('to_location')
                     ->get();

                     // dd($data);
        return view('pages.logs.transfer.transferdetail',compact('data'));
    }

else{

    // dd($_GET['selected']);
    $date = $_GET['selected'];
    $selected_date = Carbon::parse($date)->format('Y-m-d');
    // dd($selected_date);
    $data = searchlogs::select(DB::raw('count(*) as num_of_occ,to_location'))
                     ->where('type', 'transfer')
                     ->whereDate('search_date', $selected_date)
                     ->groupBy('to_location')
                     ->get();

                     // dd($data);
        return view('pages.logs.transfer.transferdetail',compact('data','date'));
}
    }

    public function transferpdf($month,$date,$year){

        // return $_GET['date'];
        $selected_date1 = $month.'/'.$date.'/'.$year; 
        $selected_date = Carbon::parse($selected_date1)->format('Y-m-d');
        // dd($selected_date);
        $data = searchlogs::select(DB::raw('count(*) as num_of_occ,to_location'))
                     ->where('type', 'transfer')
                     ->whereDate('search_date', $selected_date)
                     ->groupBy('to_location')
                     ->get();
                     // dd($data);
        $pdf = PDF::loadView('pages.logs.transfer.transferpdf',compact('data','selected_date1'));
            return $pdf->stream('transfer'.$selected_date.'.pdf');
        // dd($selected_date);
    }

    public function transferlocation($month,$date,$year,$location){
        // dd($location);
        $selected_date1 = $month.'/'.$date.'/'.$year; 
        $selected_date = Carbon::parse($selected_date1)->format('Y-m-d');
        // dd($selected_date);
        $data = searchlogs::where('type','transfer')->where('to_location', 'like', '%' . $location . '%')->whereDate('search_date', $selected_date)->get();

        // dd($data);
        return view('pages.logs.transfer.transferlocation',compact('data','selected_date','location'));


    }

    public function transferlocationpdf($date,$location){

        // dd($date);
        $selected_date = Carbon::parse($date)->format('Y-m-d');
        // dd($selected_date);
        $data = searchlogs::where('type','transfer')->where('to_location', 'like', '%' . $location . '%')->whereDate('search_date', $selected_date)->get();

        $pdf = PDF::loadView('pages.logs.transfer.transferlocationpdf',compact('data','selected_date'));
            return $pdf->stream('transfer_location'.$selected_date.'.pdf');
    }
/////////////////////////////////////////////////////////////////////////////////////

    
}
