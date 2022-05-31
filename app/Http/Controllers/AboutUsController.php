<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\PartnersLogos;
use DB;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AboutUs = AboutUs::first();
        $PartnersLogos = PartnersLogos::get();
        return view('pages.AboutUs.AboutUs',compact('AboutUs','PartnersLogos'));
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
            'first_heading' => 'required|string',
            'first_sub_heading' => 'required|string',
            'first_paragraph' => 'required|string',
            'second_heading' => 'required|string',
            'second_sub_heading' => 'required|string',
            'second_paragraph' => 'required|string'
        ]);
        DB::beginTransaction();
        try{
            $AboutUs = AboutUs::where('id', 1)->first();
            if ($request->hasFile('first_image') && $request->first_image != ''){
                $this->validate($request, ['first_image' => 'image|mimes:gif,jpeg,png,jpg|max:10000']);

                if(is_file('public/app/about_us/'.$AboutUs->first_image)){
                    unlink(public_path().'/app/about_us/'.$AboutUs->first_image);
                }
                $first_image = time().'.'.$request->first_image->getClientOriginalExtension();
                $request->first_image->move(public_path('/app/about_us/'), $first_image);

                $AboutUs->first_image = 'about_us/'.$first_image;
            }

            if ($request->hasFile('second_image') && $request->second_image != ''){
                $this->validate($request, ['second_image' => 'image|mimes:gif,jpeg,png,jpg|max:10000']);

                if(is_file('public/app/about_us/'.$AboutUs->second_image)){
                    unlink(public_path().'/app/about_us/'.$AboutUs->second_image);
                }
                $second_image = time().'.'.$request->second_image->getClientOriginalExtension();
                $request->second_image->move(public_path('/app/about_us/'), $second_image);

                $AboutUs->second_image = 'about_us/'.$second_image;
            }
            

            $AboutUs->first_heading = $request->first_heading;
            $AboutUs->first_sub_heading = $request->first_sub_heading;
            $AboutUs->first_paragraph = $request->first_paragraph;

            $AboutUs->second_heading = $request->second_heading;
            $AboutUs->second_sub_heading = $request->second_sub_heading;
            $AboutUs->second_paragraph = $request->second_paragraph;
            $AboutUs->update();

            DB::commit();

            session()->flash('msg-success', 'About Us Record Updated Successfully!');
            return redirect()->route('about_us.index');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with( 'error', $e->getLine() .' - '.$e->getMessage() );
        }
        
    }
    public function about_us_partners(Request $request)
    {
        $this->validate($request, ['partner_logos' => 'image|mimes:gif,jpeg,png,jpg|max:10000']);

        DB::beginTransaction();
        try{

            $PartnersLogos = new PartnersLogos;

            $logo = time().'.'.$request->partner_logos->getClientOriginalExtension();
            $request->partner_logos->move(public_path('/app/partner_logos/'), $logo);

            $PartnersLogos->logo = 'partner_logos/'.$logo;
            $PartnersLogos->save();

            DB::commit();

            session()->flash('msg-success', 'Partner Logos Inserted Successfully!');
            return redirect()->route('about_us.index');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with( 'error', $e->getLine() .' - '.$e->getMessage() );
        }
        
    }
    public function about_us_partners_destory(Request $request)
    {
        $PartnersLogos = PartnersLogos::findOrFail($request->id);

        if(is_file('public/app/partner_logos/'.$PartnersLogos->logo)){
            unlink(public_path().'/app/partner_logos/'.$PartnersLogos->logo);
        }
        $PartnersLogos->delete();
       
        session()->flash('msg-success', 'Partner Logos Record Deleted Successfully!');
        return redirect()->route('about_us.index'); 
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
