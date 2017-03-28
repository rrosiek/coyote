<?php
namespace App\Http\Controllers;

use App\Models\HomePage as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
