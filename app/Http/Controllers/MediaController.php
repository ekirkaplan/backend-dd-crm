<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MediaController extends Controller
{
    /**
     * @param string $id
     * @return BinaryFileResponse|string
     */
    public function getMediaById(string $id): BinaryFileResponse|string
    {
        $media = Media::find($id);

        if (is_null($media)) {
            return '//via.placeholder.com/150';
        }

        $mediaPath = Storage::path($media->path());

        return response()->file($mediaPath, [
            'Content-Type' => $media->mime_type,
            'Content-Length' => $media->size,
            'Cache-Control' => 'max-age=31536000, public',
        ]);
    }
}
