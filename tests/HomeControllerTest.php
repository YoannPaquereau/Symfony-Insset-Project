<?php


namespace App\Tests;


use Symfony\Component\Panther\PantherTestCase;

class HomeControllerTest extends PantherTestCase
{
    public function testHome() {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/');

        $this->assertPageTitleContains('Accueil');
        $sortable = $crawler->filter('.dropleft');

        $sortable->first()->click();
        $link = $sortable->filter('a')->first()->link();

        $client->click($link);
        $this->assertPageTitleContains('Accueil');
    }
}