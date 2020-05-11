<?php


namespace App\Tests;


use Symfony\Component\Panther\PantherTestCase;

class SecurityControllerTest extends PantherTestCase
{
    public function testDisplayLogin() {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/login');

        $this->assertPageTitleContains('Connexion');
        $this->assertSelectorTextContains('h1', 'Connexion');
        $this->assertSelectorNotExists('.alert.alert-danger');
    }

    public function testLoginWithBadCredentials() {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/login');
        $this->assertPageTitleContains('Connexion');

        $form = $crawler->selectButton('Envoyer')->form([
            'username' => 'Yoann',
            'password' => 'fakepassword'
        ]);

        $client->submit($form);

        $this->assertPageTitleContains('Connexion');
        $this->assertSelectorExists('.alert.alert-danger');
    }

    public function testLoginSuccess() {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/login');
        $this->assertPageTitleContains('Connexion');

        $form = $crawler->selectButton('Envoyer')->form([
            'username' => 'Yoann',
            'password' => 'paquereau60'
        ]);

        $client->submit($form);

        $this->assertPageTitleContains('Accueil');
        $client->restart();
    }
}