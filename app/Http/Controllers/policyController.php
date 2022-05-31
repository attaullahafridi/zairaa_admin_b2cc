<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\package;
use App\policy;

class policyController extends Controller
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
         $categ = policy::with('packagename')->get();
        $catdd = package::pluck('name', 'id');
        return view('pages.packagedetails.policy',compact('catdd','categ'));
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
                policy::insert([
                    'pk_id' => $request->pk_id,
                    'policy' => $request->policy,
                    'cancel_policy' => $request->cancel_policy,
                    'child' => $request->child
                ]);

                $request->session()->flash('msg-success', 'Package Policies Added successfully!');
                return redirect()->route('policy.index');

            

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
        $cat = policy::with('packagename')->where('id',$id)->first();

        $categ = policy::with('packagename')->get();
        $catdd = package::pluck('name', 'id');
        return view('pages.packagedetails.policy',compact('catdd','categ','cat'));
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
            $category = policy::where('id', $id)->first();
            // dd($category->pic_main);
            if ($category) {
                $data = $request->except('_token','_method');
                // dd($data);
                $category->update($data);
                session()->flash('msg-success', 'Package Policies Updated successfully!');
                return redirect()->route('policy.index');

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
            $category = policy::where('id', $id)->first();
            // $subcat = packagedetails::where('p_id', $id)->first();
            // dd($subcat);
            if ($category!='') {
                
                $category->delete();

                

                session()->flash('msg-success', 'Package policies has been Deleted!');
                return redirect()->route('policy.index');
            }
            else
            {
                // dd('sub cat exist');
                session()->flash('msg-error', 'Package policies Can Not Be Deleted!');
                return redirect()->route('policy.index');
            }
           
        }

            
            
        } catch (Exception $e) {

            return report($e);
        }
    }

    public function validateItems(Request $request)
    {
        $request->validate([     
            'pk_id' => 'required'   
        ]);
    }
}
