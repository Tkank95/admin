<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\members\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.application_list'));
    }

    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.application_add'));
    }

    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.application_edit')) ;

//        // Hoặc người dùng tạo ra nó hoặc người dùng là admin mới có quyền update
//        or $user->id == $application->user_id or $user->position = 1;
    }

    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.access.application_delete'));
    }

    public function restore(User $user)
    {
        //
    }

    public function forceDelete(User $user)
    {
        //
    }
}
