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
            'file' => [
                'required',
                'file',
                'mimetypes:video/avi,video/mpeg,video/quicktime,image/jpeg,image/png,image/jpg',
                'max:2000000',
            ],
            'type' => 'required|string|in:video-file,channel-logo,video',
            'name' => 'nullable|string',
        ]);

        if ($request->type === 'video') {
            $name = $request->name;
            if (!$name) {
                $name = time();
            }

            $name .= '.' . $request->file('file')->getClientOriginalExtension();
            
            $fileName = Storage::disk('ftp')->putFileAs('', $request->file('file'), );
        } else {
            $path = 'public/' . $request->type;
            $fileName = Storage::putFile($path, $request->file('file'));
        }
        

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
