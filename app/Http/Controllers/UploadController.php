<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Interfaces\Data\TempFileInterface;
use App\Interfaces\TempFileRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function __construct(private TempFileRepositoryInterface $tempFileRepository)
    {}

    public function upload(UploadFileRequest $request)
    {
        $tempDir = TempFileInterface::TEMP_FILES_DIR . date('Y_m_d');
        $file = $request->file('file');
        $path = (string)Storage::put($tempDir, $file);
        $fileId = $this->tempFileRepository->save($path);
        return response()->json(['fileId' => $fileId]);
    }
}
