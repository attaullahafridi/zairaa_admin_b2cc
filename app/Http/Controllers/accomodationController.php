<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\package;
use App\accomodation;

class accomodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $categ = accomodation::with('packagename')->get();
        $catdd = package::pluck('name', 'id');
        return view('pages.packageoptions.accomodation',compact('catdd','categ'));
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

               
                if ($request->file('image') != null) {
                $imageName = basename('accomodationimage-'.time().'-'.rand(000000,999999).'.'.$request->file('image')->getClientOriginalExtension());

                $path = $request->file('image')->move('public/images',$imageName);


                // store into db
                accomodation::insert([
                    'pk_id' => $request->pk_id,
                    'destination' => $request->destination,
                    'description' => $request->description,
                    'image' => $imageName,
                    'hotel_name' => $request->hotel_name,
                    'hotel_star' => $request->hotel_star
                ]);

                $request->session()->flash('msg-success', 'Package Accomodation Added successfully!');
                return redirect()->route('accomodation.index');

            }

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
         $cat = accomodation::with('packagename')->where('id',$id)->first();

        $categ = accomodation::with('packagename')->get();
        $catdd = package::pluck('name', 'id');
        return view('pages.packageoptions.accomodation',compact('catdd','categ','cat'));
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
            $category = accomodation::where('id', $id)->first();
            // dd($category->pic_main);
            if ($category) {
                $data = $request->except('_token','_method');

            if ($request->file('image') != null) {

                $image_path = "public/images/".$category->image; 
                if (file_exists($image_path)) {
                       @unlink($image_path);
                   }

                $imageName = basename('accomodationimage-'.time().'-'.rand(000000,999999).'.'.$request->file('image')->getClientOriginalExtension());
                $path = $request->file('image')->move('public/images',$imageName);
                $data['image'] = $imageName;
                
            }
                // dd($data);
                $category->update($data);
                session()->flash('msg-success', 'Package Accomodation Updated successfully!');
                return redirect()->route('accomodation.index');

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
            $category = accomodation::where('id', $id)->first();
            // $subcat = packagedetails::where('p_id', $id)->first();
            // dd($subcat);
            if ($category!='') {
                
                $image_path1 = "public/images/".$category->image; 
                if (file_exists($image_path1)) {
                       @unlink($image_path1);
                   }
                
                $category->delete();

                

                session()->flash('msg-success', 'Package Accomodation has been Deleted!');
                return redirect()->route('accomodation.index');
            }
            else
            {
                // dd('sub cat exist');
                session()->flash('msg-error', 'Package Accomodation Can Not Be Deleted!');
                return redirect()->route('accomodation.index');
            }
           
        }

            
            
        } catch (Exception $e) {

            return report($e);
        }
    }

    public function validateItems(Request $request)
    {
        $request->validate([     
            'pk_id' => 'required',
            'destination' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'hotel_name' => 'required',
            'hotel_star' => 'required',
            'description' => 'required'     
        ]);
    }
}
