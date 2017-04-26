<?php
namespace App\Http\Controllers;

use App\Models\User;

class Lifetime extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Lifetime';
        $subtitle = 'Members';
        $lifetime = User::where('lifetime_member', true)
            ->orderBy('last_name')
            ->get(['first_name', 'last_name']);

        return view('members.lifetime', compact('title', 'subtitle', 'lifetime'));
    }
}
