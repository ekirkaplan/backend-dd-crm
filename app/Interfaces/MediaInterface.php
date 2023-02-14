<?php

namespace App\Interfaces;

use App\Http\Requests\Medias\StoreRequest;
use App\Models\Media;

interface MediaInterface
{
    /**
     * @param  StoreRequest $request
     * @return Media
     */
    public function upload(StoreRequest $request): Media;

    /**
     * @param  array  $data
     * @return void
     */
    public function sync(array $data): void;
}
