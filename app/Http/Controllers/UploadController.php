<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(UploadFileRequest $request)
    {
        $file = $request->file('file');
//        dd($file);
        return response()->json(['path' => 'ok']);
    }
}
