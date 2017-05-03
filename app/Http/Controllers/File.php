<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreFile;
use App\Models\File as Model;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;

class File extends Controller
{
    use ShowDownloadable;

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Files';
        $files = Model::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.files.index', compact('title', 'files'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'New File Upload';
        $file = new Model();
        $file->file = null;

        return view('admin.files.create', compact('title', 'file'));
    }

    /**
     * @param  \App\Http\Requests\StoreMinutes $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFile $request)
    {
        $path = $request->file->store('files');
        $file = new Model(['description' => $request->description]);

        $upload = new Upload([
            'file_name' => $request->file->getClientOriginalName(),
            'file_path' => $path,
            'size' => $request->file->getClientSize(),
            'mime' => $request->file->getMimeType(),
        ]);

        $file->save();
        $file->upload()->save($upload);

        return redirect()
            ->route('files.index')
            ->with('successMsg', sprintf('%s has been successfully uploaded.', $request->description));
    }

    /**
     * @param  \App\Models\Minutes $minutes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $file)
    {
        Storage::delete($file->upload->file_path);
        $file->upload()->delete();
        $file->delete();

        return redirect()
            ->route('files.index')
            ->with('successMsg', sprintf('%s has been deleted.', $file->description));
    }
}
