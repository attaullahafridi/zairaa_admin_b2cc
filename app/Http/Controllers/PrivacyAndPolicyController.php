<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use DB;

class PrivacyAndPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PrivacyPolicy = PrivacyPolicy::first();
        return view('pages.PrivacyPolicy.PrivacyPolicy',compact('PrivacyPolicy'));
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
        $this->validate($request,[
            'text' => 'required|string'
        ]);
        DB::beginTransaction();
        try{
            $PrivacyPolicy = PrivacyPolicy::where('id', 1)->first();
            $PrivacyPolicy->text = $request->text;
            $PrivacyPolicy->update();

            DB::commit();

            session()->flash('msg-success', 'Privacy And Policy Record Updated Successfully!');
            return redirect()->route('privacy_and_policy.index');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with( 'error', $e->getLine() .' - '.$e->getMessage() );
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
        // dd($id);
        // dd($request->all());
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
    }
}
