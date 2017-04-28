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
    public function index(Request $request)
    {
        $title = 'Search';
        $subtitle = 'Members';

        if ($request->expectsJson()) {
            $profiles = Model::where('latitude', '<>', '0.0000000')
                ->where('active', true)
                ->get(['id', 'latitude', 'longitude']);

            return response()->json($profiles, 200);
        }

        $profiles = Model::filterBy($request->all())
            ->orderBy('last_name')
            ->paginate(20);

        return view('members.profiles.index', compact('title', 'subtitle', 'profiles'));
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Model $profile)
    {
        if (!$profile->active)
            return response(null, 404);

        return response()->json($profile, 200);
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
        if ($profile->id !== Auth::id())
            return redirect('/');

        // Reset failed email messages if address has changed
        if ($profile->email !== $request->email)
            $profile->email_failed = null;

        $profile->fill($request->all());
        $profile->subscribed = $request->has('subscribed');
        $profile->lifetime_member = $request->has('lifetime_member');
        $profile->is_admin = $request->has('is_admin');

        $profile->save();

        return redirect()->route('profiles.edit', $profile)->with('successMsg', 'Profile information has been updated');
    }
}
