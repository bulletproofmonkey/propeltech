<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Repository\AddressRepository;
use App\Repository\Exceptions\MismatchedEntityException;
use App\Repository\Exceptions\NotFoundException;
use Tests\TestCase;

class AddressRepositoryTest extends TestCase
{
    protected AddressRepository $repository;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Recreate data file
        file_put_contents(
            storage_path('address.json'),
            '[
    {
        "first_name": "Ken",
        "last_name": "Barlow",
        "phone": "019134784929",
        "email": "ken.barlow@corrie.co.uk"
    },
    {
        "first_name": "Rita",
        "last_name": "Sullivan",
        "phone": "01913478555",
        "email": "rita.sullivan@corrie.co.uk"
    }
]'
        );

        $this->repository = new AddressRepository(storage_path());
    }

    /**
     * @return void
     * @throws NotFoundException
     */
    public function testGet(): void
    {
        $expected = (new Address())
            ->setId(0)
            ->setFirstName('Ken')
            ->setLastName('Barlow')
            ->setEmail('ken.barlow@corrie.co.uk')
            ->setPhone('019134784929');

        $this->assertEquals($expected, $this->repository->get(0));
    }

    /**
     * @return void
     * @throws NotFoundException
     */
    public function testGetNotFound(): void
    {
        $this->expectExceptionObject(new NotFoundException(Address::class, 4));

        $this->repository->get(4);
    }

    /**
     * @return void
     */
    public function testGetAll(): void
    {
        $expected = [
            (new Address())
                ->setId(0)
                ->setFirstName('Ken')
                ->setLastName('Barlow')
                ->setEmail('ken.barlow@corrie.co.uk')
                ->setPhone('019134784929'),
            (new Address())
                ->setId(1)
                ->setFirstName('Rita')
                ->setLastName('Sullivan')
                ->setEmail('rita.sullivan@corrie.co.uk')
                ->setPhone('01913478555'),
        ];

        $this->assertEquals($expected, $this->repository->getAll());
    }

    /**
     * @return void
     */
    public function testGetFiltered(): void
    {
        $expected = [
            (new Address())
                ->setId(1)
                ->setFirstName('Rita')
                ->setLastName('Sullivan')
                ->setEmail('rita.sullivan@corrie.co.uk')
                ->setPhone('01913478555'),
        ];

        $this->assertEquals($expected, $this->repository->getAll('it'));
    }

    /**
     * @return void
     * @throws NotFoundException
     * @throws MismatchedEntityException
     */
    public function testStore(): void
    {
        $address =
            (new Address())
                ->setId(2)
                ->setFirstName('Steve')
                ->setLastName('McDonald')
                ->setEmail('steve.mcdonald@corrie.co.uk')
                ->setPhone('01913478555');

        $this->assertEquals(2, $this->repository->store($address));
        $this->assertEquals($address, $this->repository->get(2));
    }

    /**
     * @return void
     * @throws NotFoundException
     */
    public function testRemove(): void
    {
        $expected = (new Address())
            ->setId(0)
            ->setFirstName('Rita')
            ->setLastName('Sullivan')
            ->setEmail('rita.sullivan@corrie.co.uk')
            ->setPhone('01913478555');

        $this->repository->remove(0);
        $this->expectExceptionObject(new NotFoundException(Address::class, 0));
        $this->repository->get(0);

        // Reload from file
        $this->repository = new AddressRepository(resource_path('test' . DIRECTORY_SEPARATOR . 'data'));
        $this->assertEquals($expected, $this->repository->get(0));
    }
}
