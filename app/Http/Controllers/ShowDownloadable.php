<?php

namespace App\Http\Controllers;

use App\Models\Upload;

trait ShowDownloadable
{
    /**
     * @param  \Illuminate\Http\Request $request
     * @param  string $token
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $download = Upload::where('token', $token)->first();

        return response()->download(
            storage_path('app/' . $download->file_path),
            $download->file_name
        );
    }
}