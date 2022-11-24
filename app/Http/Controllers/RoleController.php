<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Models\Role;
use App\Repositories\BaseRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @param BaseRepository $baseRepository
     * @param RoleRepository $roleRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(
        private BaseRepository       $baseRepository,
        private RoleRepository       $roleRepository,
        private PermissionRepository $permissionRepository
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $roles = $this->baseRepository->getAll();
        return JsonOutputFaced::setData($roles)->response();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getFiltered(Request $request): JsonResponse
    {
        $search = $request->get('search');
        $perPage = $request->get('limit', 10);
        $roles = $this->roleRepository->getFiltered($search, $perPage);
        return JsonOutputFaced::setData($roles)->response();
    }

    /**
     * @param Role $role
     * @return JsonResponse
     */
    public function show(Role $role): JsonResponse
    {
        $role = $this->baseRepository->show($role);
        return JsonOutputFaced::setData($role)->response();
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $permissions = $request->get('permissions');

        $role = $this->baseRepository->store($request->validated());
        $this->permissionRepository->sync($role, $permissions);
        return JsonOutputFaced::response();
    }

    /**
     * @param UpdateRequest $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Role $role): JsonResponse
    {
        $permissions = $request->get('permissions');
        $this->baseRepository->update($role ,$request->validated());
        $this->permissionRepository->sync($role, $permissions);
        return JsonOutputFaced::response();
    }

    /**
     * @param Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        $this->permissionRepository->detach($role);
        $this->baseRepository->destroy($role);
        return JsonOutputFaced::response();
    }
}
