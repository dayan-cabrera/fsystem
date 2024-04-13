<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Services\Contracts\UserServiceInterface;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        try {
            $credentials = $request->validate([
                'name' => 'required',
                'password' => 'required'
            ]);

            if($this->userService->login($credentials, $request)) 
                return redirect()->intended('/');
            else
                return redirect()->route('login')->with('error', 'Usuario o contraseña incorrecta.');

        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        try {

            $credentials = $request->validate([
                'name' => 'required|string|unique:users,name',
                'password' => 'required'
            ]);

            $this->userService->register($credentials);

            return redirect()->route('login');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function logout()
    {
        $this->userService->logout();
        return redirect('/');
    }
}
