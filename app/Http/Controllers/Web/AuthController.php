<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthServies;
class AuthController extends Controller
{
    public function __construct(private AuthService $authService){}
}
