<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('state')->paginate(7);
        // $sub = DB::table('city')::with('state')->all();
        // $sub = city::select('state_id')->get();
        // $sub = DB::table('city')->pluck('state_id', 'state_id');
        // $cat = DB::table('state')->where('id',$sub)->pluck('name')->all();
        // $state = DB::table('state')->select('id','name')->get(); 
        // dd($cat);
        // $categories = state::pluck('id', 'name')->get();
        return view('admin.area.city.index',['cities' => $cities]);
    }

    public function create($stateId)
    {
        $state = State::findOrFail($stateId);
        $cat = State::select('id','name')->get(); 
        // dd($state);
        return view('admin.area.city.create',[ 'stateId' => $stateId,   "state" => $state, 'cat'=>$cat ]);
    }

    public function  store(Request $request, $stateId)
    {
       // dd($request->all());
        // $state = state::find($stateId);
        // $state =  state::where('id',$stateId)->pluck('id');
        $request->validate([
            'name' => 'required','string','unique:city,name'
        ]);

        City::create([
            'name' => $request->name,
            'state_id' => $stateId
        ]);

        return redirect()->route('city.list')->with('status','City has been created!');
    }

    public function edit(City $city){
    
        return view('admin.area.city.edit',[
            'city'=>$city]);        
    }

    public function update(Request $request, City $city){
     
        $request->validate([
            'name' => 'required','string','unique:city,name'.$city->id,
        ]);

        $city->update([
            'name' => $request->name,
        ]);

        return redirect()->route('city.list')->with('status','City updated successfully!!');
    }
    
    public function destroy($cityId){
        $city = City::find($cityId);
        $city->delete();
        return redirect()->route('city.list')->with('status','City deleted successfully!!');
    }
}
