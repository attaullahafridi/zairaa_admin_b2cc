<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\SocialMedia;
use DB;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $SocialMedia = SocialMedia::first();
        $ContactUs = ContactUs::get();
        return view('pages.ContactUs.ContactUs',compact('ContactUs','SocialMedia'));
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
    public function contact_us_google_map(Request $request)
    {
        $this->validate($request,[
            'google_map_link' => 'required|string'
        ]);
        DB::beginTransaction();
        try{
            $SocialMedia = SocialMedia::where('id', 1)->first();
            $SocialMedia->google_map_link = $request->google_map_link;
            $SocialMedia->update();

            DB::commit();

            session()->flash('msg-success', 'Google Map Link Updated Successfully!');
            return redirect()->route('contact_us.index');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with( 'error', $e->getLine() .' - '.$e->getMessage() );
        }
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'heading' => 'required|string',
            'address' => 'required|string'
        ]);
        DB::beginTransaction();
        try{
            $ContactUs = new ContactUs;

            $ContactUs->heading = $request->heading;
            $ContactUs->address = $request->address;

            $ContactUs->save();

            DB::commit();

            session()->flash('msg-success', 'Branch Details Added Successfully!');
            return redirect()->route('contact_us.index');
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
        $SocialMedia = SocialMedia::first();
        $ContactUs = ContactUs::get();
        $Edit = ContactUs::where('id',$id)->first();
        return view('pages.ContactUs.ContactUs',compact('ContactUs','SocialMedia','Edit'));
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
        $this->validate($request,[
            'heading' => 'required|string',
            'address' => 'required|string'
        ]);
        DB::beginTransaction();
        try{
            $ContactUs = ContactUs::where('id',$id)->first();

            $ContactUs->heading = $request->heading;
            $ContactUs->address = $request->address;

            $ContactUs->update();

            DB::commit();

            session()->flash('msg-success', 'Branch Details Updated Successfully!');
            return redirect()->route('contact_us.index');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with( 'error', $e->getLine() .' - '.$e->getMessage() );
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
        $ContactUs = ContactUs::findOrFail($id);

        $ContactUs->delete();
       
        session()->flash('msg-success', 'Branch Details Record Deleted Successfully!');
        return redirect()->route('contact_us.index'); 
    }
}
