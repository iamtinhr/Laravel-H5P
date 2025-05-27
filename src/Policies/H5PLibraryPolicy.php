<?php

namespace Iamtinhr\LaravelH5P\Policies;

use Iamtinhr\LaravelH5P\Enums\H5PPermissionsEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class H5PLibraryPolicy
{
    use HandlesAuthorization;

    public function list(?User $user): bool
    {
//        return $user && $user->can(H5PPermissionsEnum::H5P_LIBRARY_LIST);
        return true;
    }

    public function read(?User $user): bool
    {
//        return $user && $user->can(H5PPermissionsEnum::H5P_LIBRARY_READ);
        return true;
    }

    public function create(?User $user): bool
    {
//        return $user && $user->can(H5PPermissionsEnum::H5P_LIBRARY_CREATE);
        return true;
    }

    public function delete(?User $user): bool
    {
//        return $user && $user->can(H5PPermissionsEnum::H5P_LIBRARY_DELETE);
        return true;
    }

    public function update(?User $user): bool
    {
//        return $user && $user->can(H5PPermissionsEnum::H5P_LIBRARY_UPDATE);
        return true;
    }

    public function install(?User $user): bool
    {
//        return $user && $user->can(H5PPermissionsEnum::H5P_LIBRARY_INSTALL);
        return true;
    }

    public function upload(?User $user): bool
    {
//        return $user && $user->can(H5PPermissionsEnum::H5P_LIBRARY_UPLOAD);
        return true;
    }
}
