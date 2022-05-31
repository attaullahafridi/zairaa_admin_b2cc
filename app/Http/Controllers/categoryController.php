<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\subcat;

class categoryController extends Controller
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
        $categ = category::where('status',1)->get();
        return view('pages.category.category',compact('categ'));
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
        // dd($request->all());
        $cat_name = $request->name;
        if ($cat_name!='') {
        category::insert([
            'name' => $cat_name,
            'status' => 1
        ]);

    }
        return redirect()->route('category.index');

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
        $cat = category::where('id',$id)->first();

        $categ = category::where('status',1)->get();
        return view('pages.category.category',compact('cat','categ'));
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
            $category = category::where('id', $id)->first();
            if ($category) {
                $data = $request->except('_token','_method');
                $category->update($data);
                session()->flash('msg-success', 'Category Updated successfully!');
                return redirect()->route('category.index');

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
            $category = category::where('id', $id)->first();
            $subcat = subcat::where('cat_id', $id)->first();
            // dd($subcat);
            if ($subcat=='') {
                

                $category->delete();

                

                session()->flash('msg-success', 'Category has been Deleted!');
                return redirect()->route('category.index');
            }
            else
            {
                // dd('sub cat exist');
                session()->flash('msg-error', 'Category Can Not Be Deleted!');
                return redirect()->route('category.index');
            }
           
        }

            
            
        } catch (Exception $e) {

            return report($e);
        }
    }
}
