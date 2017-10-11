<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrUpdateEvent;
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
        $events = Model::orderBy('start_date')->paginate(10);

        return view('admin.events.index', compact('title', 'events'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new Model(['start_date' => Carbon::now()]);
        $end_time = $event->end_date ? $event->end_date->format('H:m') : '';

        return view('admin.events.create', [
            'title' => 'New Event',
            'event' => $event,
            'start_time' => $event->start_date->hour . ':' . $event->start_date->minute,
            'end_time' => $end_time,
        ]);
    }

    /**
     * @param  \App\Http\Requests\StoreOrUpdateEvent $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrUpdateEvent $request)
    {
        $event = $this->storeOrUpdateEvent($request, new Model());
 
        return redirect()
            ->route('events.index')
            ->with('successMsg', sprintf('Event %s has been successfully created.', $event->title));
    }

    /**
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $event)
    {
        $end_time = $event->end_date ? $event->end_date->format('H:i') : '';

        return view('admin.events.edit', [
            'title' => 'Modify Event',
            'event' => $event,
            'start_time' => $event->start_date->format('H:i'),
            'end_time' => $end_time,
        ]);
    }

    /**
     * @param  \App\Http\Requests\StoreOrUpdateEvent $request
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrUpdateEvent $request, Model $event)
    {
        $event = $this->storeOrUpdateEvent($request, $event);
 
        return redirect()
            ->route('events.index')
            ->with('successMsg', sprintf('Event %s has been successfully updated.', $event->title));
    }

    /**
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $event)
    {
        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('successMsg', sprintf('Event %s has been deleted.', $event->title));
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Event $model
     * @return \App\Models\Event
     */
    private function storeOrUpdateEvent(Request $request, Model $model)
    {
        $model->title = $request->title;
        $model->detail = $request->detail;
        $model->start_date = new Carbon($request->start_date . ' ' . $request->start_time);

        if (!$request->start_time)
            $model->all_day = true;
  
        if ($request->end_date)
            $model->end_date = new Carbon($request->end_date . ' ' . $request->end_time);

        if ($request->frequency) {
            $model->frequency = $request->frequency;            
            $model->interval = $request->interval ?: 1;
            $model->by_day = $request->by_day ?: null;
            $model->by_set_pos = $request->by_set_pos ?: null;
            $model->until = new Carbon($request->until);
        }
       
        $model->save();

        return $model;
    }
}
