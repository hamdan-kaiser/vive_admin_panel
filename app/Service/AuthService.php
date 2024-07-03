<?php

/**
 * Created by PhpStorm.
 * User: Hashibul Hasan
 * Date: 01-Jul-19
 * Time: 1:46 PM
 */

namespace App\Service;


use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $userRepository;

    // Constructor to bind model to repo
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authenticate($request){
        return Auth::attempt(['email' => $request->email, 'password' => $request->password]);
    }
}
