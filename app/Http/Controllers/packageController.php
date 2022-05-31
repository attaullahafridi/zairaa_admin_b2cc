<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\subcat;
use App\package;
use App\packagedetails;

class packageController extends Controller
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
        $categ = package::with('subcategory','category')->where('status',1)->get();
        // dd($categ);
        $catdd = category::pluck('name', 'id');
        return view('pages.package.package',compact('catdd','categ'));
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

               
                if ($request->file('thumbnail') != null && $request->file('header_image') != null) {
                $imageName = basename('pkgthumbnail-'.time().'-'.rand(000000,999999).'.'.$request->file('thumbnail')->getClientOriginalExtension());
                

                 $imageName1 = basename('pkgheadimage-'.time().'-'.rand(000000,999999).'.'.$request->file('header_image')->getClientOriginalExtension());
                
                $path = $request->file('thumbnail')->move('public/images',$imageName);
                $path1 = $request->file('header_image')->move('public/images',$imageName1);


                // store into db
                package::insert([
                    'sub_cat_id' => $request->sub_cat_id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'thumbnail' => $imageName,
                    'header_image' => $imageName1,
                    'package_price_adult' => $request->package_price_adult,
                    'package_price_child' => $request->package_price_child,
                    'status' => 1
                ]);

                $request->session()->flash('msg-success', 'Package Added successfully!');
                return redirect()->route('package.index');

            }

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
        $cat = package::with('subcategory','category')->where('id',$id)->first();

        $categ = package::with('subcategory','category')->where('status',1)->get();
        // dd($categ);
        $catdd = category::pluck('name', 'id');
        return view('pages.package.package',compact('catdd','categ','cat'));
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
                $category = package::where('id', $id)->first();
                // dd($category->pic_main);
                if ($category) {
                    $data = $request->except('_token','_method');

                    if ($request->file('thumbnail') != null) {

                        $image_path = "public/images/".$category->thumbnail; 
                        if (file_exists($image_path)) {
                            @unlink($image_path);
                        }

                        $imageName = basename('pkgthumbnail-'.time().'-'.rand(000000,999999).'.'.$request->file('thumbnail')->getClientOriginalExtension());
                        $path = $request->file('thumbnail')->move('public/images',$imageName);
                        $data['thumbnail'] = $imageName;
                    }

                    if ($request->file('header_image') != null)
                    {
                        $image_path1 = "public/images/".$category->header_image; 
                        if (file_exists($image_path1)) {
                            @unlink($image_path1);
                        }
                        $imageName1 = basename('pkgheadimage-'.time().'-'.rand(000000,999999).'.'.$request->file('header_image')->getClientOriginalExtension());
                        $path1 = $request->file('header_image')->move('public/images',$imageName1);
                        $data['header_image'] = $imageName1;
                    }
                    $category->update($data);
                    session()->flash('msg-success', 'Package Updated successfully!');
                    return redirect()->route('package.index');
                }
            }
        }
        catch (Exception $e) {
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
            $category = package::where('id', $id)->first();
            $subcat = packagedetails::where('p_id', $id)->first();
            // dd($subcat);
            if ($subcat=='') {
                
                $image_path1 = "public/images/".$category->thumbnail; 
                if (file_exists($image_path1)) {
                       @unlink($image_path1);
                   }
                $image_path = "public/images/".$category->header_image; 
                if (file_exists($image_path)) {
                       @unlink($image_path);
                   }
                $category->delete();

                

                session()->flash('msg-success', 'Package has been Deleted!');
                return redirect()->route('package.index');
            }
            else
            {
                // dd('sub cat exist');
                session()->flash('msg-error', 'Package Can Not Be Deleted!');
                return redirect()->route('package.index');
            }
           
        }

            
            
        } catch (Exception $e) {

            return report($e);
        }
    }

    public function getsubcat(Request $request){

        
         $id = $request->cat_id;

        $getallsubcat = subcat::where('cat_id',$id)->get();

        return $getallsubcat;

    }

    public function validateItems(Request $request)
    {
        $request->validate([     
            'sub_cat_id' => 'required',
            'name' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'header_image' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'description' => 'required',
            'package_price_adult' => 'required',
            'package_price_child' => 'required',
            // 'image_name' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg'
            // 'item_name' => 'unique:items,item_name|required'     
        ]);
    }
}
