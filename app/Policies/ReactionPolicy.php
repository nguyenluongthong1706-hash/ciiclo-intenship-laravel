<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reaction;
use Illuminate\Auth\Access\Response;

class ReactionPolicy
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
        return $user->role === "ADMIN" || $user->role === "USER"
        ? Response::allow()
        : Response::deny('Bạn không có quyển đánh giá bài đăng!');
    }

    public function update (User $user) {
        return $user->role === "ADMIN" || $user->role === "USER"
        ? Response::allow()
        : Response::deny('Bạn không có quyển đánh giá bài đăng!');
    }

    public function delete (User $user, Reaction $reaction) {
        return $user->id === $reaction->reviewer_id
        ? Response::allow()
        : Response::deny('Bạn không có quyển xóa đánh giá bài đăng!');
    }
}
