<?php

namespace App\Tests;

use App\Entity\HomePage;
use PHPUnit\Framework\TestCase;

class HomePageUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $homepage = new HomePage();

        $homepage->setTitle('title')
            ->setWelcomeText('welcome text')
            ->setAboutTitle('about title')
            ->setAboutText('about text')
            ->setServicesTitle('services title')
            ->setServicesText('services text');

        $this->assertTrue($homepage->getTitle() === 'title');
        $this->assertTrue($homepage->getWelcomeText() === 'welcome text');
        $this->assertTrue($homepage->getAboutTitle() === 'about title');
        $this->assertTrue($homepage->getAboutText() === 'about text');
        $this->assertTrue($homepage->getServicesTitle() === 'services title');
        $this->assertTrue($homepage->getServicesText() === 'services text');
    }

    public function testIsFalse(): void
    {
        $homepage = new HomePage();

        $homepage->setTitle('title')
            ->setWelcomeText('welcome text')
            ->setAboutTitle('about title')
            ->setAboutText('about text')
            ->setServicesTitle('services title')
            ->setServicesText('services text');

        $this->assertFalse($homepage->getTitle() === 'false');
        $this->assertFalse($homepage->getWelcomeText() === 'false');
        $this->assertFalse($homepage->getAboutTitle() === 'false');
        $this->assertFalse($homepage->getAboutText() === 'false');
        $this->assertFalse($homepage->getServicesTitle() === 'false');
        $this->assertFalse($homepage->getServicesText() === 'false');
    }

    public function testIsEmpty(): void
    {
        $homepage = new HomePage();

        $this->assertEmpty($homepage->getTitle());
        $this->assertEmpty($homepage->getWelcomeText());
        $this->assertEmpty($homepage->getAboutTitle());
        $this->assertEmpty($homepage->getAboutText());
        $this->assertEmpty($homepage->getServicesTitle());
        $this->assertEmpty($homepage->getServicesText());
    }
}
