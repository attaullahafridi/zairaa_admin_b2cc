<?php

namespace App\Http\Controllers;

use App\description;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\subscribe;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $result=subscribe::first();
        // dd($result);
        return view('pages.packagedetails.subscribe',compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id==1) {
            $model=subscribe::find($request->id);
            if ($request->hasfile('subsc_img')) {
                if(file_exists('public/images/'.$model->image)){
                    unlink('public/images/'.$model->image);
                }
                $image=$request->file('subsc_img');
                $ext=$image->extension();
                $image_name=time().'.'.$ext;
                // $image->storeAs(,$image_name);
                $image->move('public/images/', $image_name);
                $model->image=$image_name;
            }
        $model->color=$request->color;
        $result=$model->save();
        return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\description  $description
     * @return \Illuminate\Http\Response
     */
    public function show(description $description)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\description  $description
     * @return \Illuminate\Http\Response
     */
    public function edit(description $description)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\description  $description
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, description $description)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\description  $description
     * @return \Illuminate\Http\Response
     */
    public function destroy(description $description)
    {
        
    }
}
