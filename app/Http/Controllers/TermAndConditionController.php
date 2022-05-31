<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TermAndCondition;
use DB;

class TermAndConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TermAndCondition = TermAndCondition::first();
        return view('pages.TermAndCondition.TermAndCondition',compact('TermAndCondition'));
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
            $TermAndCondition = TermAndCondition::where('id', 1)->first();

            $TermAndCondition->text = $request->text;
            $TermAndCondition->update();

            DB::commit();

            session()->flash('msg-success', 'Term And Condition Record Updated Successfully!');
            return redirect()->route('term_and_condition.index');
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
