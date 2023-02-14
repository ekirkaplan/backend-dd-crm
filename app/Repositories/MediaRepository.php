<?php

namespace App\Repositories;

use App\Http\Requests\Medias\StoreRequest;
use App\Interfaces\MediaInterface;
use App\Models\Media;
use App\Models\ModelMedia;


class MediaRepository implements MediaInterface
{
    /**
     * @param  Medium  $media
     */
    public function __construct(protected Media $media)
    {
    }

    /**
     * @param  array  $data
     * @return Media
     */
    public function upload(StoreRequest $request): Media
    {
        $file = $request->file('file');
        $fileName = str($file->getClientOriginalName())->slug()->value();
        $fileFullName = $fileName.".".$file->extension();

        $data = [
            'name' => $fileName,
            'extension' => $file->extension(),
            'full_name' => $fileFullName,
            'size' => $file->getSize(),

        ];

        $timeAndDate = now()->format('d_m_Y');
        $uploadDir = public_path("uploads/{$timeAndDate}");

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir);
        }


        if (is_file($uploadDir."/".$fileFullName)) {
            $newName = $fileName.rand(100, 200).".".$file->extension();
            $data['full_name'] = $newName;
            $file->move($uploadDir, $newName);
            $data['path'] = $uploadDir."/".$newName;
        } else {
            $file->move($uploadDir, $fileFullName);
            $data['path'] = $uploadDir."/".$fileFullName;
        }

        return $this->media->create($data);
    }

    /**
     * @param  array  $data
     * @return void
     */
    public function sync(array $data): void
    {
        foreach ($data['files'] as $item) {
            $arr = [
                'model_type' => $data['model_type'],
                'model_id' => $data['model_id'],
                'media_id' => $item['id'],
            ];
            ModelMedia::create($arr);
        }
    }
}
