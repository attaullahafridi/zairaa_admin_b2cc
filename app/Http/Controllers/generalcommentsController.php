<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\generalcomments;

class generalcommentsController extends Controller
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
        $categ = generalcomments::where('status',1)->get();
        return view('pages.homepage.generalcomments',compact('categ'));
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

               
                if ($request->file('comm_image') != null) {
                $imageName = basename('comm_image-'.time().'-'.rand(000000,999999).'.'.$request->file('comm_image')->getClientOriginalExtension());
                
                $path = $request->file('comm_image')->move('public/images',$imageName);


                // store into db
                generalcomments::insert([
                    'name' => $request->name,
                    'description' => $request->description,
                    'comm_image' => $imageName,
                    'status' => 1
                ]);

                $request->session()->flash('msg-success', 'Comment Added successfully!');
                return redirect()->route('generalcomments.index');

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

        $cat = generalcomments::where('id',$id)->first();

        $categ = generalcomments::where('status',1)->get();

        return view('pages.homepage.generalcomments',compact('cat','categ'));
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
            $category = generalcomments::where('id', $id)->first();
            // dd($category->pic_main);
            
                $data = $request->except('_token','_method');

            if ($request->file('comm_image') != null) {

                $image_path = "public/images/".$category->thumbnail; 
                if (file_exists($image_path)) {
                       @unlink($image_path);
                   }

                $imageName = basename('comm_image-'.time().'-'.rand(000000,999999).'.'.$request->file('comm_image')->getClientOriginalExtension());
                $path = $request->file('comm_image')->move('public/images',$imageName);
                $data['comm_image'] = $imageName;
                
            }
                // dd($data);
                $category->update($data);
                session()->flash('msg-success', 'Comment Updated successfully!');
                return redirect()->route('generalcomments.index');

            
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
            $category = generalcomments::where('id', $id)->first();
            
            
                $image_path = "public/images/".$category->comm_image; 
                if (file_exists($image_path)) {
                       @unlink($image_path);
                   }
                $category->delete();

                

                session()->flash('msg-success', 'Comment has been Deleted!');
                return redirect()->route('generalcomments.index');
            
            
           
        }

            
            
        } catch (Exception $e) {

            return report($e);
        }
    }

    public function validateItems(Request $request)
    {
        $request->validate([     
            'name' => 'required',
            'description' => 'required',
            'comm_image' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg'
        ]);
    }
}
