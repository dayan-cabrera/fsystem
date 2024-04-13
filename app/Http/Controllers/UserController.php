<?php

namespace App\Http\Controllers;

use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index() {
        $users = $this->userService->getAllUsers();

        return view('user.index', compact('users'));
    }

    public function destroy($id) {
        $this->userService->deleteUser($id);
        return back()->with('success', 'Eliminado');
    }

    public function viewRole($id) {
        $user = $this->userService->getUser($id);
        $roles = $this->userService->availableRole($user);
        
        return view('user.role', compact('user', 'roles'));
    }

    public function role($id, Request $request) {

        $role = $request->validate([
            'role' => 'required|string',
        ]);
        // dd($role['role']);

        $this->userService->assignRole($id, $role['role']);
    
        return redirect()->route('user.index')->with('success', 'Rol asignado');
    }

}
