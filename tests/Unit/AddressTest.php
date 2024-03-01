<?php

use App\Models\Address;
use Tests\TestCase;

class AddressTest extends TestCase
{
    /**
     * @return void
     */
    public function testToArray(): void
    {
        $address = (new Address())
            ->setId(0)
            ->setFirstName('Ken')
            ->setLastName('Barlow')
            ->setEmail('ken.barlow@corrie.co.uk')
            ->setPhone('019134784929');

        $this->assertEquals(
            [
                'first_name' => 'Ken',
                'last_name'  => 'Barlow',
                'email'      => 'ken.barlow@corrie.co.uk',
                'phone'      => '019134784929',
            ],
            $address->toArray()
        );
    }

    /**
     * @return void
     */
    public function testFromJson(): void
    {
        $address = (new Address())
            ->setFirstName('Ken')
            ->setLastName('Barlow')
            ->setEmail('ken.barlow@corrie.co.uk')
            ->setPhone('019134784929');

        $addressFromArray = (new Address())
            ->fromArray([
                            'first_name' => 'Ken',
                            'last_name'  => 'Barlow',
                            'email'      => 'ken.barlow@corrie.co.uk',
                            'phone'      => '019134784929',
                        ]);

        $this->assertEquals($address, $addressFromArray);
    }
}
