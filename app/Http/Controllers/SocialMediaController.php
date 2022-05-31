<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialMedia;
use DB;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $SocialMedia = SocialMedia::first();
        return view('pages.SocialMedia.SocialMedia',compact('SocialMedia'));
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
        DB::beginTransaction();
        try{
            $SocialMedia = SocialMedia::where('id', 1)->first();
            if ($request->hasFile('site_logo') && $request->site_logo != ''){
                $this->validate($request, ['site_logo' => 'image|mimes:gif,jpeg,png,jpg|max:10000']);

                if(is_file('public/app/site_images/'.$SocialMedia->logo)){
                    unlink(public_path().'/app/site_images/'.$SocialMedia->logo);
                }
                $site_logo = time().'.'.$request->site_logo->getClientOriginalExtension();
                $request->site_logo->move(public_path('/app/site_images/'), $site_logo);

                $SocialMedia->logo = 'site_images/'.$site_logo;
            }

            if ($request->hasFile('site_fav_icon') && $request->site_fav_icon != ''){
                $this->validate($request, ['site_fav_icon' => 'image|mimes:gif,jpeg,png,jpg|max:10000']);

                if(is_file('public/app/site_images/'.$SocialMedia->fav_icon)){
                    unlink(public_path().'/app/site_images/'.$SocialMedia->fav_icon);
                }
                $fav_icon = time().'.'.$request->site_fav_icon->getClientOriginalExtension();
                $request->site_fav_icon->move(public_path('/app/site_images/'), $fav_icon);

                $SocialMedia->fav_icon = 'site_images/'.$fav_icon;
            }
            if ($request->hasFile('preloader') && $request->preloader != ''){
                $this->validate($request, ['preloader' => 'image|mimes:gif,jpeg,png,jpg|max:10000']);

                if(is_file('public/app/site_images/'.$SocialMedia->preloader)){
                    unlink(public_path().'/app/site_images/'.$SocialMedia->preloader);
                }
                $preloader = time().'.'.$request->preloader->getClientOriginalExtension();
                $request->preloader->move(public_path('/app/site_images/'), $preloader);

                $SocialMedia->preloader = 'site_images/'.$preloader;
            }
            

            $SocialMedia->facebook = $request->facebook;
            $SocialMedia->youtube = $request->youtube;
            $SocialMedia->twitter = $request->twitter;
            $SocialMedia->instagram = $request->instagram;
            $SocialMedia->linkdin = $request->linkdin;
            $SocialMedia->googleplus = $request->googleplus;
            $SocialMedia->update();
            DB::commit();
            session()->flash('msg-success', 'Social Media Record Updated Successfully!');
            return redirect()->route('social_media.index');

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
