<?php

namespace App\Http\Controllers\Api\File;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class FileController extends ApiController
{
    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => [
                'required',
                'file',
                'mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime,image/jpeg,image/png,image/jpg',
                'max:4000000',
            ],
            'type' => 'required|string|in:video-file,channel-logo,video,season',
            'name' => 'nullable|string',
        ]);

        if ($request->type === 'video') {
            if ($request->file('file')->getClientMimeType() !== 'video/mp4') {
                throw ValidationException::withMessages([
                    'file' => ['The provided file is not a video file.'],
                ]);
            }
            $name = $request->name;
            if (!$name) {
                $name = time();
            }
            $name .= '.' . $request->file('file')->getClientOriginalExtension();
            
            $fileName = Storage::disk('ftp')->putFileAs('', $request->file('file'), $name);
        } else if ($request->type === 'season') {
            if ($request->file('file')->getClientMimeType() !== 'video/mp4') {
                throw ValidationException::withMessages([
                    'file' => ['The provided file is not a video file.'],
                ]);
            }
            $name = $request->name;
            $name .= microtime(true) . '.' . $request->file('file')->getClientOriginalExtension();
            
            $fileName = Storage::disk('ftp')->putFileAs('', $request->file('file'), $name);
        }else {
            $this->validate($request, [
                'file' => [
                    'required',
                    'file',
                    'mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime,image/jpeg,image/png,image/jpg',
                    'max:10000',
                ],
                'type' => 'required|string|in:video-file,channel-logo,video',
                'name' => 'nullable|string',
            ]);
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
