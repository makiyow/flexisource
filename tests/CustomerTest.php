<?php

use Illuminate\Support\Facades\Http;
use Faker\Factory as Faker;

class CustomerTest extends TestCase
{
    /**
     * Test data provider API.
     *
     * @return void
     */
    public function testDataProvider()
    {
        $faker = Faker::create();
        $gender = $faker->randomElement(['male', 'female']);

        /**
         * Mock the HTTP client response.
         */
        $client = Http::fake([
            'https://randomuser.me/api' => Http::response(json_encode([
                "results" => [
                    [
                        "gender" => $gender,
                        "name" => [
                            "first" => $faker->firstName($gender),
                            "last" => $faker->lastName($gender),
                        ],
                        "location" => [
                            "city" => $faker->city(),
                            "country" => $faker->country(),
                        ],
                        "email" => $faker->email(),
                        "login" => [
                            "username" => $faker->userName(),
                            "password" => $faker->password()
                        ],
                        "phone" => $faker->phoneNumber(),
                    ],
                ]
            ]), 200),
        ]);

        $response = $client->get("https://randomuser.me/api");
        $responseData = json_decode($response->body(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->body());
        $this->assertArrayHasKey("results", $responseData);
        $this->assertIsArray($responseData["results"]);
        $this->assertNotEmpty($responseData["results"]);

        /**
         * Assert the structure of the first item in 'results' array
         */
        $firstResult = $responseData["results"][0];
        $this->assertArrayHasKey("name", $firstResult);
        $this->assertArrayHasKey("first", $firstResult["name"]);
        $this->assertArrayHasKey("last", $firstResult["name"]);
        $this->assertArrayHasKey("email", $firstResult);
        $this->assertArrayHasKey("login", $firstResult);
        $this->assertArrayHasKey("username", $firstResult["login"]);
        $this->assertArrayHasKey("password", $firstResult["login"]);
        $this->assertArrayHasKey("gender", $firstResult);
        $this->assertArrayHasKey("location", $firstResult);
        $this->assertArrayHasKey("country", $firstResult["location"]);
        $this->assertArrayHasKey("city", $firstResult["location"]);
        $this->assertArrayHasKey("phone", $firstResult);
    }

    public function testApiEndpoint()
    {
        $this->json('GET',  '/api/customers')->assertResponseOk();
        $this->json('GET',  '/api/customers')->seeJsonStructure(['*'=>[
            'fullname',
            'email',
            'country',
        ]]);

        $this->json('GET',  '/api/customers/0')->assertResponseStatus(404);
        $this->json('GET',  '/api/customers/0')->seeJsonStructure(['error']);

        $this->json('GET',  '/api/customers/1')->assertResponseStatus(200);
        $this->json('GET',  '/api/customers/1')->seeJsonStructure([
            'fullname',
            'email',
            'username',
            'gender',
            'country',
            'city',
            'phone'
        ]);
    }
}
