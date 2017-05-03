<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsletter;
use App\Models\Newsletter as Model;
use App\Models\Upload;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class Newsletter extends Controller
{
    use ShowDownloadable;

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Newsletters';
        $newsletters = Model::orderBy('created_at', 'desc')->paginate(20);

        if (ends_with(Route::currentRouteName(), 'admin'))
            return view('admin.newsletters.index', compact('title', 'newsletters'));

        $subtitle = 'Members';

        return view('members.newsletters.index', compact('title', 'subtitle', 'newsletters'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'New Newsletter';
        $newsletter = new Model();
        $newsletter->document = null;

        return view('admin.newsletters.create', compact('title', 'newsletter'));
    }

    /**
     * @param  \App\Http\Requests\StoreNewsletter $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsletter $request)
    {
        $path = $request->document->store('newsletters');
        $newsletter = new Model(['name' => $request->name]);

        $upload = new Upload([
            'file_name' => $request->document->getClientOriginalName(),
            'file_path' => $path,
            'size' => $request->document->getClientSize(),
            'mime' => $request->document->getMimeType(),
        ]);

        $newsletter->save();
        $newsletter->upload()->save($upload);

        return redirect()
            ->route('newsletters.admin')
            ->with('successMsg', sprintf('Newsletter %s has been successfully added.', $newsletter->name));
    }

    /**
     * @param  \App\Models\Newsletter $minutes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $newsletter)
    {
        Storage::delete($newsletter->upload->file_path);
        $newsletter->upload()->delete();
        $newsletter->delete();

        return redirect()
            ->route('newsletters.admin')
            ->with('successMsg', sprintf('Newsletter %s has been deleted.', $newsletter->name));
    }
}
