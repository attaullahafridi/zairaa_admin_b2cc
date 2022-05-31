<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\promotionalfair;
use DB;

class promotionalfairController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categ = promotionalfair::paginate(5);
      return view('pages.promotionalfair.promotionalfair',compact('categ'));
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
    public function db_format_date($date)
    {
        return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
    }
    public function store(Request $request)
    {
      $this->validateItems($request);
      try
      {
        if($request)
        {
          promotionalfair::insert([
            'flight_code' => $request->flight_code,
            'origin' => $request->origin,
            'destination' => $request->destination,
            'selling_date' => $this->db_format_date($request->selling_date),
            'travel_date' => $this->db_format_date($request->travel_date),
            'promotion_amount' => $request->promotion_amount,
          ]);

          $request->session()->flash('msg-success', 'Promotional Fair Added successfully!');
          return redirect()->route('promotionalfair.index');
        }
        else
        {
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
        $cat = promotionalfair::where('id',$id)->first();
        $categ = promotionalfair::paginate(6);
        return view('pages.promotionalfair.promotionalfair',compact('categ','cat'));
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
      $this->validateItems($request);
      try
      {
        if ($id)
        {
          $category = promotionalfair::where('id', $id)->first();
          if ($category)
          {
            $data = $request->except('_token','_method');
            $category->update($data);
            session()->flash('msg-success', 'Promotional Fair Updated Successfully!');
            return redirect()->route('promotionalfair.index');
          }
        }
      }
      catch (Exception $e)
      {
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
      try
      {
        if ($id)
        {
          $category = promotionalfair::where('id', $id)->first();
          $category->delete();
          session()->flash('msg-success', 'Promotional Fair has been Deleted!');
          return redirect()->route('promotionalfair.index');
        }
        else
        {
          session()->flash('msg-error', 'Promotional Fair Can Not Be Deleted!');
          return redirect()->route('promotionalfair.index');
        }
      }
      catch (Exception $e)
      {
        return report($e);
      }
    }
    public function validateItems(Request $request)
    {
      $data = [
          'flight_code' => 'required',
          // 'origin.*' => 'required',
          // 'destination.*' => 'required',
          'selling_date' => 'required',
          'travel_date' => 'required',
          'promotion_amount' => 'required'
      ];
      // if($request->sector != '')
      //     $data['sector'] = 'max:3|min:3';
      // if($request->rbd != '')
      //     $data['rbd'] = 'max:1|min:1';
      $request->validate($data);
    }
    public function getAllAirPorts($q = null)
    {
      $airport = DB::table('flight_airport');
      if ($q != null) {
        $airport = $airport->where('code','LIKE','%'.$q.'%')->orWhere('city','LIKE','%'.$q.'%')->orWhere('airport_name','LIKE','%'.$q.'%');
      }
      
      $airport = $airport->get(['airport_name','code']);

      $first_array = [];
      $sec_array = [];
      foreach ($airport as $key => $value) {
        if ($value->code==strtoupper($q)) {
          $first_array[]=array(
              'code' => $value->code,
              'airport_name' => $value->airport_name,
            );
        }
        else{
          $sec_array[]=array(
              'code' => $value->code,
              'airport_name' => $value->airport_name,
            );
        }
      }

      $record = array_merge($first_array,$sec_array);

      return response()->json($record);
    }
}

