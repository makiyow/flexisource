<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    protected $cxRepo;

    public function __construct(CustomerRepository $cxRepo)
    {
        $this->cxRepo = $cxRepo;
    }

    public function index()
    {
        return view("customers.index", [
            "customers" => $this->cxRepo->showAll(),
        ]);
    }

    public function show($id)
    {
        $customer = $this->cxRepo->showCustomer($id);

        if($customer) {
            return view("customers.details", ["customer" => $customer]);
        } else {
            return response(["error"=>"Resource not found."], 404);
        }
    }
}
