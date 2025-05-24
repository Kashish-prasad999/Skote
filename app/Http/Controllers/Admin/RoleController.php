<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::get();
        return view('admin.role-permission.role.index',[
            'roles' => $roles
        ]);
    }

    public function create(){
        return view('admin.role-permission.role.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required','string','unique:roles,name',
        ]);

        Role::create([
            'name' => $request->name,
        ]);
        return redirect()->route('roles.index')->with('status','Role created successfully!!');
    }

    public function edit(Role $role){
    
        return view('admin.role-permission.role.edit',[
            'role'=>$role]);        
    }

    public function update(Request $request, Role $role){
     
        $request->validate([
            'name' => 'required','string','unique:roles,name'.$role->id,
        ]);
        // $role= Role::find('id');
        // Role::update([
        //     'name' => $request->name,
        // ]);

        $role->update([
            'name' => $request->name,
        ]);

        // $role->update($request->name);
        return redirect()->route('roles.index')->with('status','Role updated successfully!!');
    }
    
    public function destroy($roleId){
        $role = Role::find($roleId);
        $role->delete();
        return redirect()->route('roles.index')->with('status','Role deleted successfully!!');
    }

    public function addPermissionToRole($roleId){

        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions  = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id",$role->id)
            ->pluck("role_has_permissions.permission_id","role_has_permissions.permission_id")
            ->all();
        // return view('role-permission.add-permission',compact('permissions','role','rolePermissions'));
        return view('admin.role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId){

        $request->validate([
            'permission'=>'required'
        ]);
        $role=Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('status','Permission added to role');
    }
}
