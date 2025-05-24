<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $states = State::paginate(7);
        return view('admin.area.state.index',['states'=>$states]);
    }

    public function create()
    {
        return view('admin.area.state.create');
    }

    public function  store(Request $request)
    {
       // dd($request->all());
        
        $request->validate([
            'name' => 'required','string','unique:state,name'
        ]);

        State::create([
            'name' => $request->name
        ]);

        return redirect()->route('state.list')->with('status','State has been created!');
    }

    public function edit(State $state){
    
        return view('admin.area.state.edit',[
            'state'=>$state]);        
    }

    public function update(Request $request, State $state){
     
        $request->validate([
            'name' => 'required','string','unique:state,name'.$state->id,
        ]);

        $state->update([
            'name' => $request->name,
        ]);

        return redirect()->route('state.list')->with('status','State updated successfully!!');
    }
    
    public function destroy($stateId){
        $state = State::find($stateId);
        $state->delete();
        return redirect('state')->with('status','State deleted successfully!!');
    }
}
