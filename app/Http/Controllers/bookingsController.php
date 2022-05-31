<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hotelbookings;
use App\activitybooking;
use App\transferbookings;
use App\booking;
use App\Models\Flight\FlightCustomers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

class bookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = booking::with('flight_booking','flight_booking.flight_customers')->orderby('id','desc')->paginate(100);
        return view('pages.bookings',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function update_ticket_number(Request $request)
    {
        try {
            $data = FlightCustomers::where('id',$request->id)->first();
            if (!empty($data)) {
                // $data = booking::where('id',$data->id)->first();
                $data->ticket_number = $request->ticket_number;
                $data->ticket_status = 'ISSUED';
                $data->ticket_date = now();
                $data->update();
                $all_customer_data = FlightCustomers::where('booking_id',$data->booking_id)->get();
                if (!empty($all_customer_data)) {
                    $all_customer_checked = true;
                    foreach ($all_customer_data as $customer_key => $customer_value) {
                        if ($customer_value->ticket_number == null) {
                            $all_customer_checked = false;
                        }
                    }
                    if ($all_customer_checked == true) {
                        $booking_data = booking::where('b_id',$data->booking_id)->first();
                        $booking_data->ticket_status = 1;
                        $booking_data->update();
                    }
                }
                session()->flash('msg-success', 'Ticket Number Updated SuccessFully.');
                return redirect()->route('bookings.index');
            }
            else{
                session()->flash('msg-error', 'Customer ID Not Found.');
                return redirect()->route('bookings.index');
            }
        }
        catch (Exception $e) {
            return report($e);
        }
    }
    public function update_paymnt_status(Request $request)
    {
        try {
            $data = booking::where('id',$request->id)->first();
            if (!empty($data)) {
                $data->payment_status = $request->payment_status;
                $data->update();
                session()->flash('msg-success', 'Payment Status Updated SuccessFully Updated.');
                return redirect()->route('bookings.index');
            }
            else{
                session()->flash('msg-error', 'Booking ID Not Found.');
                return redirect()->route('bookings.index');
            }
        }
        catch (Exception $e) {
            return report($e);
        }
    }
    public function update_pnr(Request $request)
    {
        try {
            $data = booking::where('id',$request->id)->first();
            if (!empty($data)) {
                $data->reference = $request->pnr;
                $data->update();
                session()->flash('msg-success', 'PNR Updated SuccessFully Updated.');
                return redirect()->route('bookings.index');
            }
            else{
                session()->flash('msg-error', 'Booking ID Not Found.');
                return redirect()->route('bookings.index');
            }
        }
        catch (Exception $e) {
            return report($e);
        }
        # code...
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
