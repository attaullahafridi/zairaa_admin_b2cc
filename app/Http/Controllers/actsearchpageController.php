<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\actsearchpage;

class actsearchpageController extends Controller
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
        $categ = actsearchpage::where('status',1)->paginate(5);
        return view('pages.searchpage.actsearchpage',compact('categ'));

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

               
                if ($request->file('ad_banner_1') != null) {

                $imageName = basename('ad_banner_1-'.time().'-'.rand(000000,999999).'.'.$request->file('ad_banner_1')->getClientOriginalExtension());
                $path1 = $request->file('ad_banner_1')->move('public/images',$imageName);

            }
            if( $request->file('ad_banner_2') != null){

                $imageName1 = basename('ad_banner_2-'.time().'-'.rand(000000,999999).'.'.$request->file('ad_banner_2')->getClientOriginalExtension());
                $path2 = $request->file('ad_banner_2')->move('public/images',$imageName1);
            
            }
            if ($request->file('ad_banner_3') != null) {
                $imageName2 = basename('ad_banner_3-'.time().'-'.rand(000000,999999).'.'.$request->file('ad_banner_3')->getClientOriginalExtension());
            $path3 = $request->file('ad_banner_3')->move('public/images',$imageName2);
            }

            if ($request->file('search_image') != null) {
                
                $imageName3 = basename('search_image-'.time().'-'.rand(000000,999999).'.'.$request->file('search_image')->getClientOriginalExtension());
                
                
                
                $path4 = $request->file('search_image')->move('public/images',$imageName3);
            }


                // store into db
                actsearchpage::insert([
                    'ad_banner_1' => $imageName,
                    'ad_banner_2' => $imageName1,
                    'ad_banner_3' => $imageName2,
                    'status' => 1,
                    'search_image' => $imageName3
                ]);

                $request->session()->flash('msg-success', 'Activity Banner Added successfully!');
                return redirect()->route('actsearchpage.index');

            

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
        $cat = actsearchpage::where('id',$id)->first();

        $categ = actsearchpage::where('status',1)->paginate(5);

        return view('pages.searchpage.actsearchpage',compact('cat','categ'));
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
            $category = actsearchpage::where('id', $id)->first();
            // dd($category->pic_main);
            
                $data = $request->except('_token','_method');

            
                

                if ($request->file('ad_banner_1') != null) {

                    $image_path = "public/images/".$category->ad_banner_1; 
                if (file_exists($image_path)) {
                       @unlink($image_path);
                   }


                $imageName = basename('ad_banner_1-'.time().'-'.rand(000000,999999).'.'.$request->file('ad_banner_1')->getClientOriginalExtension());
                $path = $request->file('ad_banner_1')->move('public/images',$imageName);
                $data['ad_banner_1'] = $imageName;

            }
            if( $request->file('ad_banner_2') != null){

                $image_path1 = "public/images/".$category->ad_banner_2; 
                if (file_exists($image_path1)) {
                       @unlink($image_path1);
                   }

                $imageName1 = basename('ad_banner_2-'.time().'-'.rand(000000,999999).'.'.$request->file('ad_banner_2')->getClientOriginalExtension());
                $path2 = $request->file('ad_banner_2')->move('public/images',$imageName1);
                $data['ad_banner_2'] = $imageName1;
            
            }
            if ($request->file('ad_banner_3') != null) {

                $image_path2 = "public/images/".$category->ad_banner_3; 
                if (file_exists($image_path2)) {
                       @unlink($image_path2);
                   }

                $imageName2 = basename('ad_banner_3-'.time().'-'.rand(000000,999999).'.'.$request->file('ad_banner_3')->getClientOriginalExtension());
                $path3 = $request->file('ad_banner_3')->move('public/images',$imageName2);
                $data['ad_banner_3'] = $imageName2;
            }

            if ($request->file('search_image') != null) {

                 $image_path3 = "public/images/".$category->search_image; 
                if (file_exists($image_path3)) {
                       @unlink($image_path3);
                   }
                
                $imageName3 = basename('search_image-'.time().'-'.rand(000000,999999).'.'.$request->file('search_image')->getClientOriginalExtension());
                $path4 = $request->file('search_image')->move('public/images',$imageName3);
                $data['search_image'] = $imageName3;
            }
                
            
                // dd($data);
                $category->update($data);
                session()->flash('msg-success', 'Activity Banners Updated successfully!');
                return redirect()->route('actsearchpage.index');

            
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
            $category = actsearchpage::where('id', $id)->first();
            
            
                $image_path = "public/images/".$category->ad_banner_1; 
                if (file_exists($image_path)) {
                       @unlink($image_path);
                   }

                   $image_path1 = "public/images/".$category->ad_banner_2; 
                if (file_exists($image_path1)) {
                       @unlink($image_path1);
                   }

                   $image_path2 = "public/images/".$category->ad_banner_3; 
                if (file_exists($image_path2)) {
                       @unlink($image_path2);
                   }

                    $image_path3 = "public/images/".$category->search_image; 
                if (file_exists($image_path3)) {
                       @unlink($image_path3);
                   }

                $category->delete();

                

                session()->flash('msg-success', 'Activity banners has been Deleted!');
                return redirect()->route('actsearchpage.index');
            
            
           
        }

            
            
        } catch (Exception $e) {

            return report($e);
        }
    }

    public function validateItems(Request $request)
    {
        $request->validate([     
            'ad_banner_1' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'ad_banner_2' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'ad_banner_3' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'search_image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg'
        ]);
    }
}
