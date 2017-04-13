<?php
namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use App\Models\User as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class User extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin', ['only' => 'index']);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Model $user)
    {
    }

    /**
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $user)
    {
        if (Gate::denies('update-user', $user, Auth::user()))
            return redirect('/');

        $title = $user->name;
        $subtitle = 'Update Profile';

        return view('members.users.edit', compact('title', 'subtitle', 'user'));
    }

    /**
     * @param  \App\Http\Requests\UpdateUser $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, Model $user)
    {
        if (Gate::denies('update-user', $user, Auth::user()))
            return redirect('/');
        
        $user->fill($request->all());
        $user->subscribed = $request->has('subscribed');
        $user->save();

        return redirect()->route('users.edit', [$user])->with('successMsg', 'User info has been updated');
    }
}
