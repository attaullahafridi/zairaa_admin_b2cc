<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\package;
use App\pkgimages;
use DB;


class pkgimagesController extends Controller
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
         $categ = pkgimages::with('packagename')->get();
        $catdd = package::pluck('name', 'id');
        return view('pages.packagedetails.pkgimages',compact('catdd','categ'));
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
        // $this->validateItems($request);
        try{
            
            $files = $request->file('image_url');
            $file_count = count($files);

            $destinationPath = 'public/images/';

            $uploadcount = 0;

            foreach($files as $file) {
              $rules = array('file' => 'required');

                $extension = $file->getClientOriginalExtension();
                $fileName = rand(11111,99999).'.'.$extension;
                $file->move($destinationPath, $fileName);
                // Image::make($destinationPath.$fileName)->fit(1200, 800)->save($destinationPath.$fileName);     

                $uploadcount ++;
                $newpic = 'pic'.$uploadcount;


                pkgimages::insert([
                    'pk_id' => $request->pk_id,
                    'image_url' => $fileName
                    ]);

            }


                $request->session()->flash('msg-success', 'Package Images Added successfully!');
                return redirect()->route('pkgimages.index');

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
            $category = pkgimages::where('id', $id)->first();
            // $subcat = packagedetails::where('p_id', $id)->first();
            // dd($subcat);
            if ($category!='') {
                
                $image_path1 = "public/images/".$category->image_url; 
                if (file_exists($image_path1)) {
                       @unlink($image_path1);
                   }
                
                $category->delete();

                

                session()->flash('msg-success', 'Package Image has been Deleted!');
                return redirect()->route('pkgimages.index');
            }
            else
            {
                // dd('sub cat exist');
                session()->flash('msg-error', 'Package Image Can Not Be Deleted!');
                return redirect()->route('pkgimages.index');
            }
           
        }

            
            
        } catch (Exception $e) {

            return report($e);
        }
    }

    public function validateItems(Request $request)
    {
        $request->validate([     
            'pk_id' => 'required',
            'image_url' => 'image|mimes:jpeg,png,jpg,bmp,gif,svg'   
        ]);
    }
}
