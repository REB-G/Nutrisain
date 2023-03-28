<?php

namespace App\Tests;

use App\Entity\Opinions;
use PHPUnit\Framework\TestCase;

class OpinionsUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $opinion = new Opinions();

        $opinion->setRating(5);
        $opinion->setComment('comment');

        $this->assertTrue($opinion->getRating() === 5);
        $this->assertTrue($opinion->getComment() === 'comment');
    }

    public function testIsFalse(): void
    {
        $opinion = new Opinions();

        $opinion->setRating(5);
        $opinion->setComment('comment');

        $this->assertFalse($opinion->getRating() === 'false');
        $this->assertFalse($opinion->getComment() === 'false');
    }

    public function testIsEmpty(): void
    {
        $opinion = new Opinions();

        $this->assertEmpty($opinion->getRating());
        $this->assertEmpty($opinion->getComment());
    }
}
