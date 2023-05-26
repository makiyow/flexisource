<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Repositories\CustomerRepository;

class CustomerImporter
{
    protected $cxRepo;

    public function __construct(CustomerRepository $cxRepo)
    {
        $this->cxRepo = $cxRepo;
    }

    public function import()
    {
        try {
            $response = Http::get(url("https://randomuser.me/api"), [
                "results" => 200,
                "nationality" => "AU"
            ]);

            $responseData = $response->json("results");

            foreach($responseData AS $data) {
                $customer = $this->cxRepo->findByEmail($data["email"]);

                if($customer) {
                    /**
                     * If customers email exists, update.
                     */
                    $this->cxRepo->storeCustomer(
                        $customer->getId(), 
                        $data["name"]["first"],
                        $data["name"]["last"],
                        $data["login"]["username"],
                        $data["login"]["password"],
                        $data["gender"],
                        $data["location"]["country"],
                        $data["location"]["city"],
                        $data["phone"],
                    );
                } else {
                    /**
                     * Create new customer.
                     */
                    $this->cxRepo->createCustomer(
                        $data["name"]["first"],
                        $data["name"]["last"],
                        $data["email"],
                        $data["login"]["username"],
                        $data["login"]["password"],
                        $data["gender"],
                        $data["location"]["country"],
                        $data["location"]["city"],
                        $data["phone"]
                    );
                }
            }
        } catch(\Throwable $e) {
            return $e->getMessage();
        }
    }
}
