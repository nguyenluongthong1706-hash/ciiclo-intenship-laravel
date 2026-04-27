<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
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
        return $user->role === "ADMIN"
        ? Response::allow()
        : Response::deny('Bạn không có quyển tạo danh mục bài đăng!');
    }

    public function update (User $user) {
        return $user->role === "ADMIN"
        ? Response::allow()
        : Response::deny('Bạn không có quyển cập nhật danh mục bài đăng!');
    }

    public function delete (User $user) {
        return $user->role === "ADMIN"
        ? Response::allow()
        : Response::deny('Bạn không có quyển xóa danh mục bài đăng!');
    }
}
