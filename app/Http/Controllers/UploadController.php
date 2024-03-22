<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(UploadFileRequest $request)
    {
        $tempDir = "/temp_files/" . date('Y_m_d');
        $file = $request->file('file');
        $path = Storage::put($tempDir, $file);

        // TODO: Store to temp_file table and return {path: $path, fileId: <file_id>}
        return response()->json(['path' => 'ok']);
    }
}
