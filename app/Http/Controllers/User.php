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
        $users = (new Model)->query();

        if ($request->has('filter')) {
            $users->where('first_name', 'like', '%' . $request->filter . '%')
                ->orWhere('last_name', 'like', '%' . $request->filter . '%')
                ->orWhere('email', 'like', '%' . $request->filter . '%');
        }

        $users = $users->paginate(20);

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

        return view('admin.users.edit', compact('title', 'subtitle', 'user'));
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
        $user->subscribed = $request->has('subscribed');
        $user->lifetime_member = $request->has('lifetime_member');
        $user->is_admin = $request->has('is_admin');
        $user->save();

        return redirect()->route('users.index', $user)->with('successMsg', 'User info has been updated');
    }
}
