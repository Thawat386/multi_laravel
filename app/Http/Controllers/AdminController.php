<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Hash;
use App\Permission;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administrator']);

    }

    public function dashboard(){

        return view('admin.dashboard');
    }

    public function userIndex(){
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('admin.manage.user.index', compact('users'));
    }

    public function userCreate(){
        $roles = Role::all();

        return view('admin.manage.user.create', compact('roles'));
    }

    public function userStore(Request $request){
        $this->validate($request, [
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:users'
        ]);

        if(!empty($request->password)){
            $password = trim($request->password);
        }else{
            $password = 'password';

        }

        $user = new User;
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = Hash::make($password);

        $user->save();
        $user->syncRoles(explode(',', $request->roles));

        return redirect()->route('userIndex');

    }

    public function userShow($id){
        $user = User::find($id);
        
        return view('admin.manage.user.show', compact('user'));

    }

    public function userEdit($id){
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.manage.user.edit', compact('user', 'roles'));
    }

    public function userUpdate(Request $request ,$id){
        $this->validate($request, [
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:users,email'
        ]);

        $user = User::find($id);

        if($request->donotchange == true){

            $password = $user->password;
           
        }else{

            $password = $request->password;
            $user->password     = Hash::make($password);

        }

        $user->name         = $request->name;
        $user->email        = $request->email;
        
        $user->save();
        $user->syncRoles(explode(',', $request->roles));

        return redirect()->route('userIndex');
    }

    public function permissionIndex(){
        $permissions = Permission::orderBy('id', 'desc')->paginate(10);

        return view('admin.manage.permission.index', compact('permissions'));
    
    }

    public function permissionCreate(){

        return view('admin.manage.permission.create');
    }

    // public function permissionStore(Request $request){
    //     if($request->permission_type == 'basic'){
    //         $this->validate($request, [
    //             'display_name'      => 'required|max:255',
    //             'slug'              => 'required|max:255|alphadash|unique:permission,name',

    //         $permission = new Permission;
    //         $permission->display_name       = $request->display_name;
    //         $permission->description        = $request->description;
    //         $permission->save();

    //         return redirect()->route('permissionIndex');

    //     }else if ($request->permission_type == 'crud'){
    //         $this->validate($request, [
    //             'resource'      => 'required|min:3|max:100|alpha'
    //         ]);

    //         $crud = explode(',', $request->crud_selected);F

    //         if(count($crud) > 0){
    //             foreach($crud as $x){
    //                 $display_name   = ucwords($x . ' ' . $request->resource);
    //                 $slug           = strtolower($x) . '-' . $request->resource;
    //                 $description    = "Allow a user to " . strtoupper($x) . ' a ' . ucwords($request->resource);

    //                 $permission = new Permission;
    //                 $permission->display_name       = $display_name;
    //                 $permission->slug               = $slug;
    //                 $permission->description        = $description;
    //                 $permission->save();
    //             }
    //         }

    //         return redirect()->route('permissionIndex');

    //     }else{

    //         return redirect()->route('permissionCreate')->withInput();
    //     }

    // }

    public function destroy($id)
    {
        contact::find($id)->delete();
        return redirect('/contact');
    }
}


