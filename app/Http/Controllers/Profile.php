<?php
namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use App\Models\User as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Profile extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Search';
        $subtitle = 'Members';
        // $users = Model::orderBy('last_name')->paginate(20);

        return view('members.profiles.index', compact('title', 'subtitle'));
        // return view('members.profiles.index', compact('title', 'users'));
    }

    /**
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Model $profile)
    {
    }

    /**
     * @param  \App\Models\User $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $profile)
    {
        if ($profile->id !== Auth::id())
            return redirect('/');

        $title = $profile->name;
        $subtitle = 'Update Profile';

        return view('members.profiles.edit', compact('title', 'subtitle', 'profile'));
    }

    /**
     * @param  \App\Http\Requests\UpdateUser $request
     * @param  \App\Models\User $profile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, Model $profile)
    {
        // TODO: see if address was updated -> geocode

        if ($profile->id !== Auth::id())
            return redirect('/');
        
        $profile->fill($request->all());
        $profile->subscribed = $request->has('subscribed');
        $profile->save();

        return redirect()->route('profiles.edit', $profile)->with('successMsg', 'Profile information has been updated');
    }
}