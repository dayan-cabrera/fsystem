<?php

namespace App\Services\Contracts;

use Illuminate\Http\Request;

interface UserServiceInterface {
    
    public function login(array $data, Request $request);
    public function register(array $data);
    public function logout();
    public function assignRole($id, string $role);
    public function updateProfile(array $data);
    public function deleteUser($id);
    public function getAllUsers();
    public function getUser($id);
    public function availableRole($id);

}