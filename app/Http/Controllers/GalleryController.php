<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Gallery;

use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.homepage.homeGallery',['gallery' => Gallery::limit(6)->orderBy('id','desc')->get()]);
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
        if ($request->file('image') != null) {
            DB::beginTransaction();
            try {

                $imageName = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->move('public/images/gallery',$imageName);

                $dest = Gallery::create(['image'=>$imageName]);
                DB::commit();
                return redirect()->route('gallery.index')->with('msg-success', 'Image Added successfully!');
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('msg-error',$e->getMessage());
            }
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
        $dest = Gallery::where('id',$id)->first();



        $gallery = Gallery::orderBy('id','desc')->get();



        // dd($dest);

        return view('pages.homepage.homeGallery',compact('dest','gallery'));
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
                $dest = Gallery::where('id',$id)->first();

                // $data = request()->except('hotel_name','price','star','_token','_method');
                $data=[];
                if ($request->file('image') != null) {
                    $image_path = "public/images/gallery".$dest->image;
                    if (file_exists($image_path)) {
                        @unlink($image_path);
                    }
                    $imageName = $request->file('image')->getClientOriginalName();
                    $path = $request->file('image')->move('public/images/gallery',$imageName);
                    $data['image'] = $imageName;
                }
                $dest->update($data);

                DB::commit();
                return redirect()->route('gallery.index')->with('msg-success', 'Image Updated successfully!');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('msg-error',$e->getMessage());
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
        try {



            if ($id) {

                $dest = gallery::where('id',$id)->first();
                $image_path = "public/images/gallery".$dest->image;

                if (file_exists($image_path)) {
                    @unlink($image_path);
                }

                $dest->delete();
                DB::commit();
                return redirect()->route('gallery.index')->with('msg-success', 'Record Deleted successfully!');
            }



        } catch (Exception $e) {



            return report($e);

        }
    }
}
