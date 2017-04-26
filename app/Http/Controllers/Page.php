<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreOrUpdatePage;
use App\Models\Page as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Page extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Pages';
        $pages = Model::with('updatedBy')->orderBy('slug')->paginate(20);

        return view('admin.pages.index', compact('title', 'pages'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create Page';
        $page = new Model();

        return view('admin.pages.create', compact('title', 'page'));
    }

    /**
     * @param  \App\Http\Requests\StoreOrUpdatePage $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrUpdatePage $request)
    {
        $page = Model::create($request->all());

        return redirect()
            ->route('pages.index')
            ->with('successMsg', sprintf('Page %s has been successfully created.', $page->title));
    }

    /**
     * @param  \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $page)
    {
        $title = 'Edit Page';
        // TODO: Move these images to generic upload type
        $images = collect(Storage::files('public/images'))
            ->map(function ($val) {
                preg_match('/.*\/(.*\..*)/', $val, $match);

                return $match[1];
            });
  
        return view('admin.pages.edit', compact('title', 'page', 'images'));
    }

    /**
     * @param  \App\Http\Requests\StoreOrUpdatePage $request
     * @param  \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrUpdatePage $request, Model $page)
    {
        if (!$page->home_page) {
            $page->title = $request->title;
            $page->slug = $request->slug;
        }

        if ($request->snippet) $page->snippet = $request->snippet;
        if ($request->detail) $page->detail = $request->detail;
        $page->updatedBy()->associate(Auth::user());

        if ($request->image) $this->updateSnippetImage($request, $page);

        $page->save();

        return redirect()
            ->route('pages.index')
            ->with('successMsg', sprintf('Page %s image and content has been successfully updated.', $page->title));
    }

    /**
     * @param  \App\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $page)
    {
        if ($page->home_page)
            return back();

        $page->delete();

        return redirect()
            ->route('pages.index')
            ->with('successMsg', sprintf('Page %s has been deleted.', $page->title));
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Page $page
     * @return void
     */
    private function updateSnippetImage(Request $request, Model $page)
    {
        $img = Image::make($request->image->path());
        $path = sprintf('/images/%s.%s', $page->slug, $request->image->extension());

        $img->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $img->save(storage_path('/app/public' . $path));
        $page->image_public_path = sprintf('/storage' . $path);
    }
}
