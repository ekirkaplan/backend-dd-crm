<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Facades\PermissionFaced;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param BaseRepository $baseRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        private BaseRepository $baseRepository,
        private UserRepository $userRepository
    )
    {
        $model = new User();
        $this->baseRepository->init($model);
    }

    // todo: parameter
    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
//        PermissionFaced::permission('user.index');
        $users = $this->userRepository->getAll();
        return JsonOutputFaced::setData($users)->response();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
//        PermissionFaced::permission('user.index');
        $search = $request->get('search');
        $perPage = $request->get('limit', 10);
        $users = $this->userRepository->getFiltered($search, $perPage);
        return JsonOutputFaced::setData($users)->response();
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
//        PermissionFaced::permission('user.show');
        $user = $this->baseRepository->show($user);
        return JsonOutputFaced::setData($user)->response();
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
//        PermissionFaced::permission('user.edit');
        $user = $this->baseRepository->store($request->validated());
        return JsonOutputFaced::setData($user)->response();
    }

    /**
     * @param UpdateRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, User $user): JsonResponse
    {
//        PermissionFaced::permission('user.edit');
        $user = $this->baseRepository->update($user ,$request->validated());
        return JsonOutputFaced::setData($user)->response();
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
//        PermissionFaced::permission('user.destroy');
        $user = $this->baseRepository->destroy($user);
        return JsonOutputFaced::setData($user)->response();
    }
}
