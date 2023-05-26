<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepository;

class CustomerApiController extends Controller
{
    protected $cxRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CustomerRepository $cxRepo)
    {
        $this->cxRepo = $cxRepo;
    }

    public function index()
    {
        $customers = $this->cxRepo->showAll();
        $customersArray = array();
        
        foreach($customers AS $customer) {
            array_push($customersArray, [
                "fullname" => $customer->getFirstname()." ".$customer->getFirstname(),
                "email" => $customer->getEmail(),
                "username" => $customer->getUsername(),
                "gender" => $customer->getGender(),
                "country" => $customer->getCountry(),
                "city" => $customer->getCity(),
                "phone" => $customer->getPhone(),
            ]);
        }

        return response()->json($customersArray, 200);
    }

    public function show($id)
    {
        $customer = $this->cxRepo->showCustomer($id);

        if($customer) {
            $cxJson = [
                "fullname" => $customer->getFirstname()." ".$customer->getFirstname(),
                "email" => $customer->getEmail(),
                "username" => $customer->getUsername(),
                "gender" => $customer->getGender(),
                "country" => $customer->getCountry(),
                "city" => $customer->getCity(),
                "phone" => $customer->getPhone(),
            ];

            return response()->json($cxJson, 200);
        } else {
            return response(["error"=>"Resource not found."], 404);
        }
    }
}
