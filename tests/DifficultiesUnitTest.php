<?php

namespace App\Tests;

use App\Entity\Difficulties;
use PHPUnit\Framework\TestCase;

class DifficultiesUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $difficulty = new Difficulties();

        $difficulty->setName('name');

        $this->assertTrue($difficulty->getName() === 'name');
    }

    public function testIsFalse(): void
    {
        $difficulty = new Difficulties();

        $difficulty->setName('name');

        $this->assertFalse($difficulty->getName() === 'false');
    }

    public function testIsEmpty(): void
    {
        $difficulty = new Difficulties();

        $this->assertEmpty($difficulty->getName());
    }
}
