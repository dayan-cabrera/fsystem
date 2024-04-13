<?php

namespace App\Services\Contracts;

use Illuminate\Http\Request;

interface ClienteServiceInterface {
    
    public function getAllCustomers();
    public function getCustomer($id);
    public function saveCustomer(array $data);
    public function updateCustomer($id, array $data);
    public function deleteCustomer($id);

}