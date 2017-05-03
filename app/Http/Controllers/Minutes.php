<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreMinutes;
use App\Models\Minutes as Model;
use App\Models\Upload;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class Minutes extends Controller
{
    use ShowDownloadable;

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Minutes';
        $minutes = Model::orderBy('meeting_date', 'desc')->paginate(20);

        if (ends_with(Route::currentRouteName(), 'admin'))
            return view('admin.minutes.index', compact('title', 'minutes'));

        $subtitle = 'Members';

        return view('members.minutes.index', compact('title', 'subtitle', 'minutes'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'New Minutes';
        $minutes = new Model();
        $minutes->document = null;

        return view('admin.minutes.create', compact('title', 'minutes'));
    }

    /**
     * @param  \App\Http\Requests\StoreMinutes $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMinutes $request)
    {
        $meetingDate = new Carbon($request->meeting_date);
        $path = $request->document->store('minutes');
        $minutes = new Model(['meeting_date' => $meetingDate]);

        $upload = new Upload([
            'file_name' => $request->document->getClientOriginalName(),
            'file_path' => $path,
            'size' => $request->document->getClientSize(),
            'mime' => $request->document->getMimeType(),
        ]);

        $minutes->save();
        $minutes->upload()->save($upload);

        return redirect()
            ->route('minutes.admin')
            ->with('successMsg', sprintf('Minutes for %s have been successfully added.', $minutes->meeting_date->toFormattedDateString()));
    }

    /**
     * @param  \App\Models\Minutes $minute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $minute)
    {
        Storage::delete($minute->upload->file_path);
        $minute->upload()->delete();
        $minute->delete();

        return redirect()
            ->route('minutes.admin')
            ->with('successMsg', sprintf('Minutes for %s have been deleted.', $minute->meeting_date->toFormattedDateString()));
    }
}
