<?php


namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    /**0
     * Display the user's profile form.
     */
    public function index(): View
    {
        $users = User::paginate(20);
        return view('admin.index', ['users' => $users]);
    }

    public function create(): View
    {
        $roles = Role::all();
        return view('admin.addUser',['roles'=>$roles]);
    }

    public function store(Request $request): RedirectResponse
    {
        $permissions = [
            'profile.create',
            'profile.edit',
            'profile.store',
            'profile.update',
            'profile.destroy',
            'profile.permission',
            'costumer.store',
            'costumer.update',
            'costumer.destroy',
            'costumer.debt_info',
            'debt.store',
            'payment.store',
        ];

        $manager_permissions = [
            'costumer.store',
            'debt.store',
            'payment.store',
        ];

        if(Auth::user()->hasDirectPermission('profile.store')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'role' => 'required'
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            if($request->role=='admin'){
//                dd($request->role);
                $user->role=='1';
                $user->assignRole(1);
                $user->givePermissionTo($permissions);
            }else
                if($request->role=='manager'){ //ser::where('role','manager')
                    $user->role=='2';
                    $user->assignRole(2);
                    $user->givePermissionTo($permissions);
                }
            $user->save();
        }
        return redirect()->route('admin.index')->with('success', 'Muvaffaqqiyatli qo\'shildi');
    }


    public function edit($id): View
    {
        $roles = Role::all();
        $user = User::where('id', $id)->first();
        return view('admin.editUser', compact('user'),['roles'=>$roles]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
//        dd($request->all());
        if(Auth::user()->hasDirectPermission('profile.update')) {
            $request->validate([
                'id' => 'required',
                'name' => 'required',
                'password' => 'required',
                'email' => 'required',
                'role' => 'required'
            ]);

            $user['password'] = bcrypt($request->password);
            $user->name = $request->name;
            $user->email = $request->email;

            $user->save();
            $user->syncRoles($request->role);
        }
        return redirect()->route('admin.index')->with('success', 'Muvaffaqqiyatli yangilandi');
    }

    public function destroy($id)
    {
        if(Auth::user()->hasDirectPermission('profile.destroy')){
        User::where('id', $id)->delete();}
        return redirect()->back();
    }


    public function permission(User $user)
    {
        if(Auth::user()->hasDirectPermission('profile.permission')) {
            $user_permission = $user->permissions;
            $permissions = Permission::all();
        return view('admin.permissions',['user_permissions'=>$user_permission, 'user'=>$user,'permissions'=>$permissions]);
        }
    }
    public function add_permission(User $user, Request $request){

        if(!$user->hasPermissionTo($request->permission)){
            return redirect()->back();
        }
        else{
            $user->givePermissionTo($request->permission);
            return redirect()->back();
        }
    }
    public function revoke_permission($permission, User $user){
        $user->revokePermissionTo($permission);
        return redirect()->back();
    }

}
