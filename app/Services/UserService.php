<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserService implements UserServiceInterface {
    public function login(array $data, Request $request) {
        if (Auth::attempt($data)) {
            if (Auth::user()->getRoleNames()->count() > 0) {
                $request->session()->regenerate();
                return true;
            } else {
                Auth::logout();
                return false;
            }
        }
    }

    public function register(array $credentials) {

        return User::create($credentials);
    }

    public function logout() {
        Auth::logout();
    }

    public function getAllUsers() {
        return User::select('id', 'name')->get();
    }

    public function getUser($id){
        return User::findOrFail($id);
    }

    public function assignRole($id, string $role) {
        return User::find($id)->syncRoles($role);
    }

    public function updateProfile(array $data) {
        // in case of i put this option
    }

    public function deleteUser($id) {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function availableRole($user) {
        $allRoles = Role::pluck('name')->toArray();
        if(count($user->roles) > 0) {
            $roles = array_diff($allRoles, [$user->roles[0]->name]);
        } else {
            $roles = $allRoles;
        }

        return $roles;
    }

   

   

}