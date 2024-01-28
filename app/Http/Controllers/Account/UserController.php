<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Role;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $da = User::all();
        $data = "User";
        return view('master.account.user.index',compact('da','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = "Tambah User";
        $role = Role::all();
        return view('master.account.user.create',compact('data','role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [            
            'name' => 'required|unique:users,name',     
            'password'=>'required',
            'email'=>'required|unique:users,email'                        
            ];

        $request->validate($rule);
 
        $item = new User;        
        $item->name = $request->name;
        $item->email = $request->email;
        $item->role = $request->role;
        $item->password = bcrypt($request->password);
        $item->save();

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {      
        $data = "Edit User";
        $role = Role::all();
        return view('master.account.user.create',compact('data','user','role'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rule = [            
            'name' => 'required|unique:users,name,'.$user->id,     
            'email'=>'required|unique:users,email,'.$user->id,                        
            ];

        $request->validate($rule);
 
        $item = $user;        
        $item->name = $request->name;
        $item->email = $request->email;
        $item->role = $request->role;
        if($request->password)
        {
            $item->password = bcrypt($request->password);
        }
        $item->save();

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
