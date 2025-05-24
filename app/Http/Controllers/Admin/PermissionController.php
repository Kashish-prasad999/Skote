<?php

namespace App\Http\Controllers\Admin;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::get();
        return view('admin.role-permission.permission.index',[
            'permissions' => $permissions
        ]);
    }

    public function create(){
        return view('admin.role-permission.permission.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required','string','unique:permissions,name',
        ]);

        Permission::create([
            'name' => $request->name,
        ]);
        return redirect()->route('permissions.index')->with('status','Permission created successfully!!');
    }

    public function edit(Permission $permission){
    
        return view('adminrole-permission.permission.edit',[
            'permission'=>$permission]);   
            // dd($permission);
    }

    public function update(Request $request, Permission $permission){
     
        $request->validate([
            'name' => 'required','string','unique:permissions,name'.$permission->id,
        ]);
        // Permission::update([
        //     'name' => $request->name,
        // ]);
        $permission->update([
            'name' => $request->name,
        ]);
        // return view('role-permission.permission.edit', [
        //     'permission' => $permission
        // ]);

        return redirect()->route('permissions.index')->with('status','Permission updated successfully!!');
    }
    
    public function destroy($permissionId){
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect()->route('permissions.index')->with('status','Permission deleted successfully!!');
    }
}
