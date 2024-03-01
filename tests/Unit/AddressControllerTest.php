<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Repository\AddressRepository;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;

class AddressControllerTest extends TestCase
{
    /**
     * @return void
     * @throws Exception
     */
    public function testIndex(): void
    {
        $mockRepository = $this->createPartialMock(AddressRepository::class, ['getAll']);
        $mockRepository->expects($this->once())
                       ->method('getAll')
                       ->willReturn([]);

        $this->instance(AddressRepository::class, $mockRepository);

        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testCreateForm(): void
    {
        $response = $this->get('/create');
        $response->assertStatus(200);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testShow(): void
    {
        $mockRepository = $this->createPartialMock(AddressRepository::class, ['get']);
        $mockRepository->expects($this->once())
                       ->method('get')
                       ->with(1)
                       ->willReturn((new Address())->setId(1));

        $this->instance(AddressRepository::class, $mockRepository);

        $response = $this->get('/1');
        $response->assertStatus(200);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testEditForm(): void
    {
        $mockRepository = $this->createPartialMock(AddressRepository::class, ['get']);
        $mockRepository->expects($this->once())
                       ->method('get')
                       ->with(1)
                       ->willReturn((new Address())->setId(1));

        $this->instance(AddressRepository::class, $mockRepository);

        $response = $this->get('/1/edit');
        $response->assertStatus(200);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testCreateStore(): void
    {
        $mockRepository = $this->createPartialMock(AddressRepository::class, ['store']);
        $mockRepository->expects($this->once())
                       ->method('store')
                       ->with(
                           (new Address())
                               ->setFirstName('Ken')
                               ->setLastName('Barlow')
                               ->setEmail('ken.barlow@corrie.co.uk')
                               ->setPhone('01913478492')
                       );

        $this->instance(AddressRepository::class, $mockRepository);

        $response = $this->post('/create', [
            'first_name' => 'Ken',
            'last_name'  => 'Barlow',
            'email'      => 'ken.barlow@corrie.co.uk',
            'phone'      => '01913478492',
        ]);
        $response->assertStatus(302);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testEditStore(): void
    {
        $mockRepository = $this->createPartialMock(AddressRepository::class, ['store']);
        $mockRepository->expects($this->once())
                       ->method('store')
                       ->with(
                           (new Address())
                               ->setFirstName('Ken')
                               ->setLastName('Barlow')
                               ->setEmail('ken.barlow@corrie.co.uk')
                               ->setPhone('01913478492'),
                           1
                       );

        $this->instance(AddressRepository::class, $mockRepository);

        $response = $this->post('/1/edit', [
            'first_name' => 'Ken',
            'last_name'  => 'Barlow',
            'email'      => 'ken.barlow@corrie.co.uk',
            'phone'      => '01913478492',
        ]);
        $response->assertStatus(302);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testEditStoreFailure(): void
    {
        $mockRepository = $this->createPartialMock(AddressRepository::class, []);

        $this->instance(AddressRepository::class, $mockRepository);

        $response = $this->post('/1/edit', [
            'first_name' => 'Ken',
            'last_name'  => 'Barlow',
            'email'      => 'ken.barlow@corrie.co.uk',
            'phone'      => '019134784929',
        ]);
        $response->assertInvalid();
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testRemove(): void
    {
        $mockRepository = $this->createPartialMock(AddressRepository::class, ['remove']);
        $mockRepository->expects($this->once())
                       ->method('remove')
                       ->with(1);

        $this->instance(AddressRepository::class, $mockRepository);

        $response = $this->get('/1/delete');
        $response->assertStatus(302);
    }
}
