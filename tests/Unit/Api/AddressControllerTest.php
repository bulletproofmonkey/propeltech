<?php

namespace Tests\Unit\Api;

use App\Repository\AddressRepository;
use Tests\TestCase;

class AddressControllerTest extends TestCase
{
    private array $addresses = [
        [
            "first_name" => "Ken",
            "last_name"  => "Barlow",
            "phone"      => "019134784929",
            "email"      => "ken.barlow@corrie.co.uk",
            "id"         => 0,
        ],
        [
            "first_name" => "Rita",
            "last_name"  => "Sullivan",
            "phone"      => "01913478555",
            "email"      => "rita.sullivan@corrie.co.uk",
            "id"         => 1,
        ],
    ];

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Recreate data file
        file_put_contents(
            storage_path('address.json'),
            json_encode(
                $this->addresses,
                JSON_PRETTY_PRINT
            )
        );

        $this->instance(AddressRepository::class, new AddressRepository(storage_path()));
    }

    /**
     * @return void
     */
    public function testGetAllIndex(): void
    {
        $response = $this->getJson('/api');
        $response->assertStatus(200);

        $this->assertEquals($this->addresses, json_decode($response->getContent(), true));
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $response = $this->getJson('/api/1');
        $response->assertStatus(200);

        $this->assertEquals($this->addresses[1], json_decode($response->getContent(), true));
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $address = [
            'first_name' => 'Test',
            'last_name'  => 'User',
            'phone'      => '01234 123456',
            'email'      => 'no@email.com',
        ];

        $response = $this->postJson('/api', $address);
        $response->assertStatus(200);

        // Next id in sequence.
        $address['id'] = 2;

        $this->assertEquals($address, json_decode($response->getContent(), true));
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $address          = $this->addresses[0];
        $address['phone'] = "01913478492";

        $response = $this->patchJson('/api/0', $address);
        $response->assertStatus(200);

        $this->assertEquals($address, json_decode($response->getContent(), true));
    }

    /**
     * @return void
     */
    public function testUpdateWithError(): void
    {
        $address          = $this->addresses[0];

        $response = $this->patchJson('/api/0', $address);

        $response->assertStatus(422);
        $decodedContent = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('errors', $decodedContent);
        $this->assertArrayHasKey('phone', $decodedContent['errors']);

        $this->assertEquals('The phone field format is invalid.', $decodedContent['errors']['phone'][0]);
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $response = $this->deleteJson('/api/0', $this->addresses[0]);
        $response->assertStatus(204);
    }
}
