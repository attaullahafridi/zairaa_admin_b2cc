<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inspiration;

class inspirationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categ = inspiration::where('status',1)->get();
        return view('pages.homepage.inspiration',compact('categ'));
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

               
                if ($request->heading) {
                // store into db
                inspiration::insert([
                    'heading' => $request->heading,
                    'details' => $request->details,
                    'status' => 1
                ]);

                $request->session()->flash('msg-success', 'inspiration Added successfully!');
                return redirect()->route('inspiration.index');

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
         $cat = inspiration::where('id',$id)->first();

        $categ = inspiration::where('status',1)->get();

        return view('pages.homepage.inspiration',compact('cat','categ'));
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
            $category = inspiration::where('id', $id)->first();
            // dd($category->pic_main);
            
                $data = $request->except('_token','_method');

                // dd($data);
                $category->update($data);
                session()->flash('msg-success', 'Inspiration Updated successfully!');
                return redirect()->route('inspiration.index');

            
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
            $category = inspiration::where('id', $id)->first();
            
                $category->delete();

                

                session()->flash('msg-success', 'Inspiration has been Deleted!');
                return redirect()->route('inspiration.index');
            
            
           
        }

            
            
        } catch (Exception $e) {

            return report($e);
        }
    }

    public function validateItems(Request $request)
    {
        $request->validate([     
            'heading' => 'required',
            'details' => 'required'
        ]);
    }
}
