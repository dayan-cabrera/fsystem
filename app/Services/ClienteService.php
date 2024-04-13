<?php

namespace App\Services;

use App\Models\Cliente;
use App\Services\Contracts\ClienteServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ClienteService implements ClienteServiceInterface {
    public function getAllCustomers() {
        return Cliente::all();
    }
    
    public function getCustomer($id) {
        return Cliente::findOrFail($id);
    }
    
    public function saveCustomer(array $data) {
        return Cliente::create($data);
    }
    
    public function updateCustomer($id, array $data) {
        return Cliente::findOrFail($id)->update($data);
    }
    
    public function deleteCustomer($id) {
        return Cliente::findOrFail($id)->delete();
    }

   

   

}