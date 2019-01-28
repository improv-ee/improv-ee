<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\Models\Media;

/**
 * @group Images
 */
class ImageController extends Controller
{

    /**
     * Get an Image
     *
     * Returns the specified Image. The Content-Type of the response is that of an image (image/png).
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @response {}
     */
    public function show($filename)
    {

        $media = Media::where('file_name',$filename)->first();

        if ($media === null) {
            return response('',404);
        }

        $path = $media->id.'/'.$media->file_name;

        $file = Storage::disk('media')->get($path);

        return Response::create($file, 200, ['Content-Type' => $media->mime_type]);
    }
}