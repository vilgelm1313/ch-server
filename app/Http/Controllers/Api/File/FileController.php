<?php

namespace App\Http\Controllers\Api\File;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends ApiController
{
    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|image',
        ]);

        $fileName = Storage::putFile('video-files', $request->file('file'));

        if ($fileName) {
            return $this->success([
                'file' => $fileName,
            ]);
        }
    }

    public function getImage(Request $request)
    {
        $this->validate($request, [
            'path' => 'required|string|max:255',
        ]);

        return response()->file(storage_path('app/' . $request->path));
    }
}
