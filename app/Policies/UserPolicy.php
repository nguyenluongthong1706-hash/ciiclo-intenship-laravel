<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny (User $user) {
        return true;
    }

    public function view (User $user) {
        return true;
    }

    public function create (User $user) {
        return true;
    }

    public function update (User $authUser, User $targetUser) {
        return $authUser->role === "ADMIN" || $authUser->id === $targetUser->id
        ? Response::allow()
        : Response::deny('Bạn không có quyển cập nhật người dùng!');
    }

    public function delete (User $authUser, User $targetUser) {
        return $authUser->role === 'ADMIN'
        ? Response::allow()
        : Response::deny('Bạn không có quyển xóa tài khoản!');
    }
}
