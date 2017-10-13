<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use App\Models\User as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User extends Controller
{
    /**
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Users';
        $users = Model::filterBy($request->all())
            ->orderBy('last_name')
            ->paginate(20);

        return view('admin.users.index', compact('title', 'users'));
    }

    /**
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $user)
    {
        $title = $user->name;
        $subtitle = 'Update User';
        $brothers = Model::orderBy('last_name')->get()->mapWithKeys(function ($brother) {
            return [$brother['id'] => $brother['last_name'] . ', ' . $brother['first_name']];
        });
        $brothers->prepend('', 0);

        return view('admin.users.edit', compact('title', 'subtitle', 'user', 'brothers'));
    }

    /**
     * @param  \App\Http\Requests\UpdateUser $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, Model $user)
    {
        // Reset failed email messages if address has changed
        if ($user->email !== $request->email)
            $user->email_failed = null;

        $user->fill($request->all());
        $user->big()->sync($request->big > 0 ? [$request->big] : []);
        $user->subscribed = $request->has('subscribed');
        $user->lifetime_member = $request->has('lifetime_member');
        $user->is_admin = $request->has('is_admin');
        $user->save();

        return redirect()->route('users.index')->with('successMsg', 'User info has been updated');
    }
}
