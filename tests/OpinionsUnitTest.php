<?php

namespace App\Tests;

use App\Entity\Opinions;
use PHPUnit\Framework\TestCase;

class OpinionsUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $opinion = new Opinions();

        $opinion->setComment('comment');

        $this->assertTrue($opinion->getComment() === 'comment');
    }

    public function testIsFalse(): void
    {
        $opinion = new Opinions();

        $opinion->setComment('comment');

        $this->assertFalse($opinion->getComment() === 'false');
    }

    public function testIsEmpty(): void
    {
        $opinion = new Opinions();

        $this->assertEmpty($opinion->getComment());
    }
}
