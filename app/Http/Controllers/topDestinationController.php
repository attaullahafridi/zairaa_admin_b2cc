<?php



namespace App\Http\Controllers;



use App\Http\Controllers\Controller;

use App\destinationHotel;

use App\topDestination;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;



class topDestinationController extends Controller

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
        // $hotel_cities=DB::table('hotel_cities')->get();
        // echo "<pre>";
        // print_r($hotel_cities);
        // echo "</pre>";
        // die();
        return view('pages.homepage.topDestination',['topDest' => topDestination::where('status',1)->get()]);

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
        // dd($request->all());
        if ($request->file('image') != null) {
            DB::beginTransaction();
            try {
                // $headerImage = $request->file('header_image')->getClientOriginalName();
                // $path1 = $request->file('header_image')->move('public/images/hotels',$headerImage);

                $imageName = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->move('public/images/hotels',$imageName);
                
                // $data = request()->except('hotel_image','hotel_name','price','star');
                // $data['header_image'] = $headerImage;
                // $data['image'] = $imageName;

                $dest = topDestination::create(['city_name'=>$request->city_name,'city_code'=>$request->city,'image'=>$imageName,'status'=>1,'description'=>$request->description]);
                // $custom_array = array();

                // if (count($request->hotel_name) > 0) {
                //     foreach ($request->hotel_name as $key => $value)
                //     {
                //         $img = $request->file('hotel_image')[$key];
                //         $hotelImage = $img->getClientOriginalName();
                //         $img->move('public/images/hotels',$hotelImage);
                //         array_push($custom_array, array(
                //             'hotel_image' => $hotelImage,
                //             'hotel_name' => $request->hotel_name[$key],
                //             'price' => $request->price[$key],
                //             'star' => $request->star[$key]
                //         ));
                //     }
                //     $dest->destinationHotel()->createMany($custom_array);
                // }
                DB::commit();
                return redirect()->route('topDestination.index')->with('msg-success', 'Destination Added successfully!');
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

        //



        $dest = topDestination::with('destinationHotel')->where('id',$id)->first();



        $topDest = topDestination::where('status',1)->get();



        // dd($dest);

        return view('pages.homepage.topDestination',compact('dest','topDest'));

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

        // dd($id,$request->all());

        try {

            if ($id) {
                $dest = topDestination::where('id',$id)->first();

                // $data = request()->except('hotel_name','price','star','_token','_method');
                $data=[];
                if ($request->file('image') != null) {
                    $image_path = "public/images/hotels".$dest->image;
                    if (file_exists($image_path)) {
                           @unlink($image_path);
                       }
                    $imageName = $request->file('image')->getClientOriginalName();
                    $path = $request->file('image')->move('public/images/hotels',$imageName);
                    $data['image'] = $imageName;
                }

                   $data['city_name']=$request->city_name;
                   $data['description']=$request->description;
                   $data['city_code']=$request->city;
                  $dest->update($data);
                // if($request->hotel_name)
                // {
                //   for ($i=0; $i <sizeof($request->hotel_name) ; $i++)
                //   {
                //     if (array_key_exists($i, $request->hotel_id)) {
                //         $data2 = [];
                //         $h_id = $request->hotel_id[$i];
                //         $dest_hotel = destinationHotel::find($h_id);
                
                //             $data2['hotel_name'] = $request->hotel_name[$i];
                //             $data2['price'] = $request->price[$i];
                //             $data2['star'] = $request->star[$i];
                //             $dest_hotel->update($data2);
                //     }
                //     else
                //     {
                //         $img = $request->file('hotel_image')[$i];
                //         $hotelImage = $img->getClientOriginalName();
                //         $img->move('public/images/hotels',$hotelImage);
                //         destinationHotel::create([
                //             'hotel_image'  => $hotelImage,
                //             'hotel_name'  => $request->hotel_name[$i],
                //             'price'       => $request->price[$i],
                //             'star'        => $request->star[$i],
                //             'top_dest_id' => $id
                //         ]);
                //     }
                //   }

                // }
                // print_r($dest_hotel->hotel_image);
                // die();
                DB::commit();
                return redirect()->route('topDestination.index')->with('msg-success', 'Destination Updated successfully!');
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

          $dest = topDestination::where('id',$id)->first();
          destinationHotel::where('top_dest_id',$id)->delete();
          $image_path = "public/images/hotels".$dest->image;
          $header_image = "public/images/hotels".$dest->header_image;

          if (file_exists($image_path)) {
                 @unlink($image_path);
             }
             
         if (file_exists($header_image)) {
             @unlink($header_image);
         }

             $dest->delete();
              DB::commit();
              return redirect()->route('topDestination.index')->with('msg-success', 'Destination Deleted successfully!');
        }

  

        } catch (Exception $e) {



            return report($e);

        }

    }


    public function get_cities(Request $r)
    {
        // $hotel_cities=\DB::table('hotel_cities')->select('code as ID','name as TEXT')->where('name', 'like', '%'.$r->q.'%')->get()->toArray();
        // // $hotel_cities=\DB::table('hotel_cities')->select('code as ID','name as TEXT')->where('TEXT', 'like', $r->q.'%')->get()->toArray();
        // print json_encode($hotel_cities);
        
        $q = $r->q;
        $cities = DB::table( 'hotel_cities' );
        if ( $q != null ){
            $q = ucfirst($q);
            if (strlen($q) <= 2) {
                $cities = $cities->select('code as ID','name as TEXT')->where( 'country_code' , 'LIKE' , '%' . $q . '%' )->get();
            }
            else{
                $cities = $cities->select('code as ID','name as TEXT')->where( 'name' , 'LIKE' , '%' . $q . '%' )->orWhere('country', 'LIKE' , '%' . $q . '%')->get();
            }
        }
        print json_encode($cities);

    }


}

