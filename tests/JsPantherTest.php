<?php


namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Panther\PantherTestCase;

class JsPantherTest extends PantherTestCase
{
    public function testJS() {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/basket');
        $this->assertSelectorTextContains('h2', 'Hello');
    }
}


/*class JsPantherTest extends WebTestCase
{
    public function testJS() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/basket');
        $this->assertSelectorTextContains('h2', 'Hello');
    }
}*/