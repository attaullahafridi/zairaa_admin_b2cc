<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\flightmarkup;

class flightmarkupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categ = flightmarkup::paginate(5);
        return view('pages.flightmarkup.flightmarkup',compact('categ'));
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
         $this->validateItems($request);
        try{
            if($request){

                // store into db
                flightmarkup::insert([
                    'flight_name' => $request->flight_name,
                    'flight_code' => $request->flight_code,
                    'amount' => $request->amount,
                ]);

                $request->session()->flash('msg-success', 'Flight Markup Added successfully!');
                return redirect()->route('flightmarkup.index');


            } else{
                return redirect()->back()->with('msg-error','Error!');
            }

        }
        catch (Exception $e) {

            return report($e);
            
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
        $cat = flightmarkup::where('id',$id)->first();

        $categ = flightmarkup::paginate(5);
        return view('pages.flightmarkup.flightmarkup',compact('categ','cat'));
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

        try {

        
        if ($id) {
            $category = flightmarkup::where('id', $id)->first();
            // dd($category->pic_main);
            if ($category) {
                $data = $request->except('_token','_method');

            
                // dd($data);
                $category->update($data);
                session()->flash('msg-success', 'Flight Markup Updated Successfully!');
                return redirect()->route('flightmarkup.index');

            }
        }
            
        } catch (Exception $e) {

            return report($e);
            
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
            $category = flightmarkup::where('id', $id)->first();
            
           
                $category->delete();

                session()->flash('msg-success', 'Flight markup has been Deleted!');
                return redirect()->route('flightmarkup.index');
          
           
        }else{

            session()->flash('msg-error', 'Flight markup Can Not Be Deleted!');
               return redirect()->route('flightmarkup.index');
        }

            
            
        } catch (Exception $e) {

            return report($e);
        }
    }



      public function validateItems(Request $request)
    {
        $request->validate([     
            'flight_name' => 'required',
            'flight_code' => 'required'
        ]);
    }
}
