<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Hash;
use App\Permission;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administrator']);
    }

    public function dashboard()
    {

        return view('admin.dashboard');
    }

    public function userIndex()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('admin.manage.user.index', compact('users'));
    }

    public function userCreate()
    {
        $roles = Role::all();

        return view('admin.manage.user.create', compact('roles'));
    }

    public function userStore(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:users'
        ]);

        if (!empty($request->password)) {
            $password = trim($request->password);
        } else {
            $password = 'password';
        }

        $user = new User;
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = Hash::make($password);

        $user->save();
        $user->syncRoles(explode(',', $request->roles));

        return redirect()->route('userIndex')->with('success', 'เพิ่มผู้ใช้งานใหม่แล้ว');
    }

    public function userShow($id)
    {
        $user = User::find($id);

        return view('admin.manage.user.show', compact('user'));
    }

    public function userEdit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.manage.user.edit', compact('user', 'roles'));
    }

    public function userUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:users,email'
        ]);

        $user = User::find($id);

        if ($request->donotchange == true) {

            $password = $user->password;
        } else {

            $password = $request->password;
            $user->password     = Hash::make($password);
        }

        $user->name         = $request->name;
        $user->email        = $request->email;

        $user->save();
        $user->syncRoles(explode(',', $request->roles));

        return redirect()->route('userIndex');
    }

    public function userDestroy($id)
    {
        
       // User::find($id)->delete();
        Alert::warning('Deleting user <br/>are you sure?')
        ->showCancelButton($btnText = 'Cancel', $btnColor = '#dc3545')
        ->showConfirmButton(
            $btnText = '<a class="add-padding" href="/multi/admin/manage/user/killdestroy/'. $id .'">Yes</a>', // here is class for link
            $btnColor = '#38c177',
            ['className'  => 'no-padding'], // add class to button
        )->autoClose(false);
            
        return redirect()->route('userIndex');
    }

    public function userkillDestroy($id)
    {
        
        User::find($id)->delete();

        return redirect()->route('userIndex');
    }

    public function permissionIndex()
    {
        $permissions = Permission::orderBy('id', 'desc')->paginate(10);

        return view('admin.manage.permission.index', compact('permissions'));
    }

    public function permissionCreate()
    {

        return view('admin.manage.permission.create');
    }

    public function permissionStore(Request $request)
    {
        if ($request->permission_type == 'basic') {
            $this->validate($request, [
                'display_name'      => 'required|max:255',
                'name'              => 'required|max:255|alphadash|unique:permissions,name',
                'description'       => 'sometimes|max:255'
            ]);

            $permission = new Permission;
            $permission->display_name         = $request->display_name;
            $permission->name                 = $request->name;
            $permission->description          = $request->description;
            $permission->save();

            return redirect()->route('permissionIndex');
        } else if ($request->permission_type == 'crud') {
            $this->validate($request, [
                'resource'      => 'required|min:3|max:100|alpha'
            ]);

            $crud = explode(',', $request->crud_selected);

            if (count($crud) > 0) {
                foreach ($crud as $x) {
                    $display_name   = ucwords($x . ' ' . $request->resource);
                    $slug           = strtolower($x) . '-' . $request->resource;
                    $description    = "Allow a user to " . strtoupper($x) . ' a ' . ucwords($request->resource);

                    $permission = new Permission;
                    $permission->display_name         = $display_name;
                    $permission->name                 = $name;
                    $permission->description          = $description;
                    $permission->save();
                }
            }

            return redirect()->route('permissionIndex');
        } else {

            return redirect()->route('permissionCreate')->withInput();
        }
    }

    public function permissionShow($id)
    {
        $permission = Permission::findOrFail($id);

        return view('admin.manage.permission.show', compact('permission'));
    }

    public function permissionEdit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('admin.manage.permission.edit', compact('permission'));
    }

    public function permissionUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'display_name'      => 'required|max:255',
            'description'       => 'sometimes|max:255'
        ]);

        $permission = Permission::findOrFail($id);
        $permission->display_name         = $request->display_name;
        $permission->description          = $request->description;
        $permission->save();

        return redirect()->route('permissionShow', $id);
    }

    public function roleIndex()
    {
        $roles = Role::orderBy('id', 'desc')->paginate(10);

        return view('admin.manage.role.index', compact('roles'));
    }

    public function roleCreate()
    {
        $permissions = Permission::all();

        return view('admin.manage.role.create', compact('permissions'));
    }

    public function roleStore(Request $request)
    {
        $this->validate($request, [
            'display_name'      => 'required|max:255',
            'name'              => 'required|max:255|alphadash|unique:permissions,name',
            'description'       => 'sometimes|max:255'
        ]);

        $role = new Role;
        $role->display_name         = $request->display_name;
        $role->name                 = $request->name;
        $role->description          = $request->description;
        $role->save();

        if ($request->permissions) {
            $role->syncPermissions(explode(',', $request->permissions));
        }

        return redirect()->route('roleIndex');
    }

    public function roleShow($id)
    {
        $role = Role::findOrFail($id);

        return view('admin.manage.role.show', compact('role'));
    }

    public function roleEdit($id)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($id);

        return view('admin.manage.role.edit', compact('permissions', 'role'));
    }

    public function roleUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'display_name'      => 'required|max:255',
            'description'       => 'sometimes|max:255'
        ]);

        $role = Role::findOrFail($id);
        $role->display_name         = $request->display_name;
        $role->description          = $request->description;
        $role->save();

        if ($request->permissions) {
            $role->syncPermissions(explode(',', $request->permissions));
        }

        return redirect()->route('roleShow', $id);
    }
}
