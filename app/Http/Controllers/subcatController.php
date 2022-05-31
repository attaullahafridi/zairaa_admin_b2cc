<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\subcat;
use App\package;

class subcatController extends Controller
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
        // dd('hello');
        $categ = subcat::with('categories')->where('status',1)->get();
        $catdd = category::pluck('name', 'id');
        return view('pages.subcat.subcat',compact('catdd','categ'));
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
        // dd($request->all());

        $this->validateItems($request);
        try{
            if($request){

               
                if ($request->file('pic_main') != null && $request->file('pic_header') != null) {
                $imageName = basename('subCatMain-'.time().'-'.rand(000000,999999).'.'.$request->file('pic_main')->getClientOriginalExtension());
                

                 $imageName1 = basename('subCatHead-'.time().'-'.rand(000000,999999).'.'.$request->file('pic_header')->getClientOriginalExtension());
                
                $path = $request->file('pic_main')->move('public/images',$imageName);
                $path1 = $request->file('pic_header')->move('public/images',$imageName1);


                // store into db
                subcat::insert([
                    'cat_id' => $request->cat_id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'pic_main' => $imageName,
                    'pic_header' => $imageName1,
                    'status' => 1
                ]);

                $request->session()->flash('msg-success', 'Item Added successfully!');
                return redirect()->route('subcat.index');

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
        $cat = subcat::where('id',$id)->first();

        $categ = subcat::with('categories')->where('status',1)->get();
        $catdd = category::pluck('name', 'id');
        return view('pages.subcat.subcat',compact('catdd','categ','cat'));
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
            $category = subcat::where('id', $id)->first();
            // dd($category->pic_main);
            if ($category) {
                $data = $request->except('_token','_method');

            if ($request->file('pic_main') != null) {

                $image_path = "public/images/".$category->pic_main; 
                if (file_exists($image_path)) {
                       @unlink($image_path);
                   }

                $imageName = basename('subCatMain-'.time().'-'.rand(000000,999999).'.'.$request->file('pic_main')->getClientOriginalExtension());
                $path = $request->file('pic_main')->move('public/images',$imageName);
                $data['pic_main'] = $imageName;
                
            }

            if ($request->file('pic_header') != null)
            {
                $image_path1 = "public/images/".$category->pic_header; 
                if (file_exists($image_path1)) {
                       @unlink($image_path1);
                   }
                $imageName1 = basename('subCatHead-'.time().'-'.rand(000000,999999).'.'.$request->file('pic_header')->getClientOriginalExtension());
                $path1 = $request->file('pic_header')->move('public/images',$imageName1);
                $data['pic_header'] = $imageName1;
            }
                // dd($data);
                $category->update($data);
                session()->flash('msg-success', 'Sub Category Updated successfully!');
                return redirect()->route('subcat.index');

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
            $category = subcat::where('id', $id)->first();
            $subcat = package::where('sub_cat_id', $id)->first();
            // dd($subcat);
            if ($subcat=='') {
                
                $image_path1 = "public/images/".$category->pic_header; 
                if (file_exists($image_path1)) {
                       @unlink($image_path1);
                   }
                $image_path = "public/images/".$category->pic_main; 
                if (file_exists($image_path)) {
                       @unlink($image_path);
                   }
                $category->delete();

                

                session()->flash('msg-success', 'Sub Category has been Deleted!');
                return redirect()->route('subcat.index');
            }
            else
            {
                // dd('sub cat exist');
                session()->flash('msg-error', 'Sub Category Can Not Be Deleted!');
                return redirect()->route('subcat.index');
            }
           
        }

            
            
        } catch (Exception $e) {

            return report($e);
        }
    }

    public function validateItems(Request $request)
    {
        $request->validate([     
            'cat_id' => 'required',
            'name' => 'required',
            'pic_main' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'pic_header' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg',
            'description' => 'required'
            // 'image_name' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg'
            // 'item_name' => 'unique:items,item_name|required'     
        ]);
    }
}
