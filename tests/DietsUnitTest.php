<?php

namespace App\Tests;

use App\Entity\Diets;
use PHPUnit\Framework\TestCase;

class DietsUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $diet = new Diets();

        $diet->setName('name');

        $this->assertTrue($diet->getName() === 'name');
    }

    public function testIsFalse(): void
    {
        $diet = new Diets();

        $diet->setName('name');

        $this->assertFalse($diet->getName() === 'false');
    }

    public function testIsEmpty(): void
    {
        $diet = new Diets();

        $this->assertEmpty($diet->getName());
    }
}
