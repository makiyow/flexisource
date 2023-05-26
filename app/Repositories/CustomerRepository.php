<?php

namespace App\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use App\Entities\Customer;

class CustomerRepository
{
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createCustomer(string $firstname, string $lastname, string $email, string $username, $password, string $gender, string $country, string $city, string $phone)
    {
        $cx = new Customer($firstname, $lastname, $email, $username, $password, $gender, $country, $city, $phone);

        $this->entityManager->persist($cx);
        $this->entityManager->flush();

        return $cx;
    }

    public function storeCustomer(int $id, string $firstname, string $lastname, string $username, string $password, string $gender, string $country, string $city, string $phone)
    {
        $cx = $this->entityManager->find(Customer::class, $id);

        $cx->setFirstname($firstname);
        $cx->setLastname($lastname);
        $cx->setUsername($username);
        $cx->setUsername($password);
        $cx->setGender($gender);
        $cx->setCountry($country);
        $cx->setCity($city);
        $cx->setPhone($phone);

        $this->entityManager->flush();

        return $cx;
    }

    public function findByEmail(string $email)
    {
        return $this->entityManager->getRepository(Customer::class)->findOneBy(['email'=>$email]);
    }

    public function showCustomer(int $customerID)
    {
        return $this->entityManager->find(Customer::class, $customerID);
    }

    public function showAll()
    {
        return $this->entityManager->getRepository(Customer::class)->findAll();
    }
}