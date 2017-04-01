<?php
namespace App\Http\Controllers;

use App\Http\Requests\UpdateHomePage;
use App\Models\HomePage as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HomePage extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Home Pages';
        $pages = Model::orderBy('slug')->get();

        return view('admin.homepages.index', compact('title', 'pages'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Implement new pages at a later time
    }

    /**
     * @param  \App\Models\HomePage $page 
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $homePage)
    {
        $title = 'Modify Home Page';
        $images = collect(Storage::files('public/images'))
            ->map(function ($val) {
                preg_match('/.*\/(.*\..*)/', $val, $match);

                return $match[1];
            });
  
        return view('admin.homepages.edit', compact('title', 'homePage', 'images'));
    }

    /**
     * @param  \App\Http\Requests\UpdateHomePage $request
     * @param  \App\Models\HomePage $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomePage $request, Model $homePage)
    {
        $homePage->fill($request->all());

        if ($request->image) {
            $img = Image::make($request->image->path());
            $path = sprintf('/images/%s.%s', $homePage->slug, $request->image->extension());

            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save(storage_path('/app/public' . $path));
            $homePage->image_public_path = sprintf('/storage' . $path);
        }

        $homePage->save();

        return redirect()
            ->route('home-pages.edit', ['page' => $homePage->id])
            ->with('successMsg', sprintf('Page %s image has been successfully updated.', $homePage->title));
    }
}
