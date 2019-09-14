<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return new \App\Mail\AdminCommentMail();
        // return new \App\Mail\AdminCommentMail(\App\Comment::first());

        $this->authorize('create', User::class);

        $users = new User;

        if ($request->has('search')) {
            $users = $users->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%');
        }

        if ($request->has('status')) {
            $status = $request->status == 1 ? 1 : 0;
            $users = $users->where('status', $status);
        }
        
        // dd($users->toSql());
        $users = $users->paginate();

        // $users = User::simplePaginate();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $roles = Role::get();

        return view('user.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'userType' => 'required|integer',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $validate['password'] = bcrypt($request->password);
        $validate['status'] = 1;

        User::create($validate);

        $roles = $request['roles'];
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();            
                $user->assignRole($role_r); //Assigning role to user
            }
        }

        return redirect()->route('user.index')->with('message', 'User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $roles = Role::get();

        return view('user.form', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'userType' => 'required|integer',
        ]);

        if ($request->filled('password')) {
            $validate1 = $request->validate([
                'password' => 'required|string|min:6|confirmed',
            ]);

            $validate = array_merge($validate, $validate1);
            // $validate['password'] = bcrypt($request->password);
        }

        $validate['status'] = $request->has('status') ? 1 : 0;
        
        $user->update($validate);

        $roles = $request['roles'];
        if (isset($roles)) {        
            $user->roles()->sync($roles);
        }
        else {
            $user->roles()->detach();
        }

        return redirect()->route('user.show', $user)->with('message', 'User successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('user.index')->with('message', 'User successfully deleted');
    }
}
