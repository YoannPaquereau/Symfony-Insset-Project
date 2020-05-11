<?php


namespace App\Tests;


use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\PantherTestCase;

class ShoppingControllerTest extends PantherTestCase
{

    public function addProduct(Client $client): void {
        $crawler = $client->request('GET', '/');

        $this->assertPageTitleContains('Accueil');

        $article = $crawler->filter('.row')->first();
        $link = $article->filter('a')->link();

        $client->click($link);
        $this->assertPageTitleContains('Mon panier');
        $this->assertSelectorNotExists('h3');
    }

    public function testEmptyBasket() {
        $client = static::createPantherClient();
        $client->request('GET', '/basket');

        $this->assertPageTitleContains('Mon panier');
        $this->assertSelectorTextContains('h3', 'Panier vide');

        $client->restart();
    }

    public function testAddArticle() {
        $client = static::createPantherClient();
        $this->addProduct($client);

        $client->restart();
    }

    public function testChange() {
        $client = static::createPantherClient();

        $this->addProduct($client);

        $crawler = $client->request('GET', '/basket');

        $this->assertSelectorTextContains('h2', 'Hello');

        $article = $crawler->filter('tbody');
        $this->assertSelectorExists('tr');

        $select = $article->filter('#quantity');
        $select->click();

        $select->filter('option')->eq(1)->click();

        $client->waitFor('select option:nth-child(2)[selected]', 1);

        $client->refreshCrawler();
        $this->assertEquals(2, $select->filter('option[selected]')->attr('value'));

        $client->restart();
    }

    public function testConfirmBasket() {
        $client = static::createPantherClient();

        $this->addProduct($client);

        $crawler = $client->request('GET', '/basket');

        $this->assertPageTitleContains('Mon panier');

        $this->assertSelectorNotExists('h3');

        $client->click($crawler->filter('a')->last()->link());

        $crawler = $client->getCrawler();

        $this->assertPageTitleContains('Connexion');

        $form = $crawler->selectButton('Envoyer')->form([
            'username' => 'Yoann',
            'password' => 'paquereau60'
        ]);

        $client->submit($form);

        $this->assertPageTitleContains('Accueil');
        $this->assertSelectorExists('.alert.alert-success');

        $client->restart();
    }
}