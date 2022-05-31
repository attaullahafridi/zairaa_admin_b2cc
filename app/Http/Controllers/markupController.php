<?php

namespace App\Http\Controllers;

use App\markup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class markupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categ = markup::get();
        $roe=\DB::table('rate_of_exchange')->where('ex_id',1)->first()->to_pkr;
        // dd($categ);
        return view('pages.markup.markup',compact('categ','roe'));
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
        $validator = Validator::make($request->all(), [
           'rateOfExchange' => ['required', 'int'],
            'hotelMarkup' => ['required', 'int']
        ]);
        //
        // dd($request->all());
        \DB::table('rate_of_exchange')->where('ex_id',1)->update(['to_pkr'=>$request->rateOfExchange]);
        \DB::table('markup')->where('id',2)->update(['percentage'=>$request->hotelMarkup]);
        $request->session()->flash('msg-success', 'Record updated successfully!');
        return redirect()->route('markup.index');
        
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
