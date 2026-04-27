<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\Response;

class PostPolicy
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
        return $user->role === "USER"
        ? Response::allow()
        : Response::deny('Bạn không có quyển tạo bài đăng!');
    }

    public function update (User $user, Post $post) {
        return $user->id === $post->author_id || $user->role === "ADMIN"
        ? Response::allow()
        : Response::deny('Bạn không có quyển cập nhật bài đăng!');
    }

    public function delete (User $user, Post $post) {
        return $user->id === $post->author_id
        ? Response::allow()
        : Response::deny('Bạn không có quyển xóa bài đăng!');
    }
}
