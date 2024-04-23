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

            if (Auth::attempt($credentials)) {
                if (Auth::user()->getRoleNames()->count() > 0) {
                    $request->session()->regenerate();
                    return redirect()->intended('dashboard');
                } else {
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'No tienes permisos para acceder.');
                }
            }

            // dd($credentials);

            return redirect()->route('login')->with('error', 'Email o contraseña incorrecta.');
        } catch (ValidationException $e) {
            // dd("npo tienes persmisos");

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
                'name' => 'required|string',
                'password' => 'required'
            ]);

            $newUser = new User();
            $newUser->name = $credentials['name'];
            $newUser->password = bcrypt($credentials['password']);
            $newUser->save();


            return redirect()->route('login');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
