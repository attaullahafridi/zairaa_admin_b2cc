<?php



namespace App\Http\Controllers;



use App\Http\Controllers\Controller;

use App\destinationHotel;

use App\topFlight;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;



class topFlightController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        //
        // dd(['topDest' => topDestination::with('destinationHotel')->where('status',1)->get()]);
        // $hotel_cities=DB::table('top_flight')->get();
        // echo "<pre>";
        // print_r($hotel_cities);
        // echo "</pre>";
        // die();
        return view('pages.homepage.topFlight',['topFlight' => topFlight::where('status',1)->get()]);

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
        if ($request->file('image') != null) {
            DB::beginTransaction();
            try {
                $imageName = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->move('public/images/flights',$imageName);
                
                $dest = topFlight::create(['title'=>$request->title,'origion'=>$request->origion,'destination'=>$request->destination,'depart_date'=>$request->Departure_Date,'image'=>$imageName,'status'=>1,'description'=>$request->description]);
                DB::commit();
                return redirect()->route('topFlight.index')->with('msg-success', 'Flight Added successfully!');
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('msg-error',$e->getMessage());
            }
        }
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
        $dest = topFlight::where('id',$id)->first();
        $topFlight = topFlight::where('status',1)->get();
        return view('pages.homepage.topFlight',compact('dest','topFlight'));

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
        try {

            if ($id) {
                $dest = topFlight::where('id',$id)->first();

                // $data = request()->except('hotel_name','price','star','_token','_method');
                $data=[];
                if ($request->file('image') != null) {
                    $image_path = "public/images/flights".$dest->image;
                    if (file_exists($image_path)) {
                       @unlink($image_path);
                    }
                    $imageName = $request->file('image')->getClientOriginalName();
                    $path = $request->file('image')->move('public/images/flights',$imageName);
                    $data['image'] = $imageName;
                }
                   $data['title']=$request->title;
                   $data['description']=$request->description;
                   $data['origion']=$request->origion;
                   $data['destination']=$request->destination;
                   $data['depart_date']=$request->Departure_Date;
                  $dest->update($data);
                
                DB::commit();
                return redirect()->route('topFlight.index')->with('msg-success', 'Record Updated successfully!');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('msg-error',$e->getMessage());
        }
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

      try {

            

        if ($id) {

          $dest = topFlight::where('id',$id)->first();
          $image_path = "public/images/flights".$dest->image;

          if (file_exists($image_path)) {
                 @unlink($image_path);
             }

             $dest->delete();
              DB::commit();
              return redirect()->route('topFlight.index')->with('msg-success', 'Record Deleted successfully!');
        }

  

        } catch (Exception $e) {



            return report($e);

        }

    }


    public function get_airport(Request $r)
    {
        $hotel_cities=\DB::table('flight_airport')->select('code as ID','airport_name as TEXT')->where('code', 'like', $r->q)->orWhere('airport_name', 'like', $r->q.'%')->get()->toArray();
        // $hotel_cities=\DB::table('hotel_cities')->select('code as ID','name as TEXT')->where('TEXT', 'like', $r->q.'%')->get()->toArray();
        print json_encode($hotel_cities);

    }


}

