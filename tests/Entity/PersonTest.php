<?php
namespace App\Tests\Entity;

use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Class PersonTest
 * @package App\Tests\Entity
 */
class PersonTest extends TestCase
{

    public function testCreate()
    {
        $person = new Person('Arthur');

        $this->assertEquals('Arthur', $person->getName());
    }
}