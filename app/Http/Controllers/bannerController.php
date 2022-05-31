<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\banner;

class bannerController extends Controller
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
        $categ = banner::where('status',1)->get();
        return view('pages.homepage.banner',compact('categ'));
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

               
                if ($request->file('slider_image') != null) {
                $imageName = basename('slider_image-'.time().'-'.rand(000000,999999).'.'.$request->file('slider_image')->getClientOriginalExtension());
                
                $path = $request->file('slider_image')->move('public/images',$imageName);


                // store into db
                banner::insert([
                    'heading' => $request->heading,
                    'sub_heading' => $request->sub_heading,
                    'slider_image' => $imageName,
                    'status' => 1
                ]);

                $request->session()->flash('msg-success', 'Slider Added successfully!');
                return redirect()->route('banner.index');

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
        $cat = banner::where('id',$id)->first();

        $categ = banner::where('status',1)->get();

        return view('pages.homepage.banner',compact('cat','categ'));
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
            $category = banner::where('id', $id)->first();
            // dd($category->pic_main);
            
                $data = $request->except('_token','_method');

            if ($request->file('slider_image') != null) {

                $image_path = "public/images/".$category->thumbnail; 
                if (file_exists($image_path)) {
                       @unlink($image_path);
                   }

                $imageName = basename('slider_image-'.time().'-'.rand(000000,999999).'.'.$request->file('slider_image')->getClientOriginalExtension());
                $path = $request->file('slider_image')->move('public/images',$imageName);
                $data['slider_image'] = $imageName;
                
            }
                // dd($data);
                $category->update($data);
                session()->flash('msg-success', 'Slider Updated successfully!');
                return redirect()->route('banner.index');

            
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
            $category = banner::where('id', $id)->first();
            
            
                $image_path = "public/images/".$category->slider_image; 
                if (file_exists($image_path)) {
                       @unlink($image_path);
                   }
                $category->delete();

                

                session()->flash('msg-success', 'Slider has been Deleted!');
                return redirect()->route('banner.index');
            
            
           
        }

            
            
        } catch (Exception $e) {

            return report($e);
        }
    }

    public function validateItems(Request $request)
    {
        $request->validate([     
            'heading' => 'required',
            'sub_heading' => 'required',
            'slider_image' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg'
        ]);
    }
}
