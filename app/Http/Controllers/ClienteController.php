<?php

namespace App\Http\Controllers;

use App\Services\Contracts\ClienteServiceInterface;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    protected $clienteService;

    public function __construct(ClienteServiceInterface $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function index() {
        $clientes = $this->clienteService->getAllCustomers();

        return view('cliente.index', compact('clientes'));
    }
}
