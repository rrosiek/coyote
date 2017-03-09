<?php
namespace App\Http\Controllers;

use App\Models\Event as Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Event extends Controller
{
    /**
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Events';
        $subtitle = 'Members';
        $events = Model::paginate(10);

        if (Route::currentRouteName() === 'events.index')
            return view('members.events.index', compact('title', 'subtitle', 'events'));

        return view('events', compact('title', 'events'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.events.create', [
            'title' => 'New Event',
            'subtitle' => 'Members',
            'event' => new Model([
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now(),
            ]),
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->all();
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
