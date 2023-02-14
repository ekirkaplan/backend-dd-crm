<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Medias\StoreRequest;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Supplier;
use App\Repositories\MediaRepository;
use Illuminate\Http\JsonResponse;

class MediasController extends Controller
{
    public function __construct(protected MediaRepository $mediaRepository)
    {
    }

    public function upload(StoreRequest $request): JsonResponse
    {

       $media = $this->mediaRepository->upload($request);

        return JsonOutputFaced::setData($media)->setMessage('Medya Yüklendi')->response();
    }

    private function modelToDirectoryName(string $model): string
    {
        if ($model === Contract::class) {
            return public_path('upload/contract');
        } elseif ($model === Employee::class) {
            return public_path('upload/employee');
        } elseif ($model === Customer::class) {
            return public_path('upload/customer');
        } elseif ($model === Supplier::class) {
            return public_path('upload/supplier');
        } else {
            return public_path('upload/other');
        }
    }
}
