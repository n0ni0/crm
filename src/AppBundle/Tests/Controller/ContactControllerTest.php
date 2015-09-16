<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Utils\Constants;

class ContactControllerTest extends webTestCase
{
  public function setUp()
  {
    $this->client = static::createClient(array(), array(
      'PHP_AUTH_USER' => 'username',
      'PHP_AUTH_PW'   => 'password',
    ));
  }

  /**
   * Test if contact page show 20 contacts
   *
   */
  public function testIfLoadContacts()
  {
    $crawler = $this->client->request('GET', '/contact');
    $this->assertCount(
      Constants::CONTACTS_PER_PAGE,
      $crawler->filter('i.glyphicon-user'),
      'The contact page displays the correct number of contacts');
  }

  public function testNewContactCreate()
  {
    $crawler = $this->client->request('GET', '/contact/new/');

    $this->assertEquals(1, $crawler->filter('h3:contains("Nuevo contacto")')->count());

    $form = $crawler->selectButton('Crear')->form();
    $form['app_ContactProfile[name]']        = 'Pepe';
    $form['app_ContactProfile[lastname]']    = 'Lopez';
    $form['app_ContactProfile[address]']     = 'C/Larga Nº14';
    $form['app_ContactProfile[city]']        = 'Chiclana de la Frontera';
    $form['app_ContactProfile[phone]']       = '956412563';
    $form['app_ContactProfile[mobilephone]'] = '632147896';
    $form['app_ContactProfile[email]']       = 'pepe@gmail.com';
    $form['app_ContactProfile[company]']     = 'empresa ficticia';
    $form['app_ContactProfile[annotations]'] = 'anotación de prueba';

    $this->client->followRedirects(true);
    $crawler = $this->client->submit($form);
    $result  = $this->client->getResponse()->getStatusCode();
    $this->assertEquals($result, 200);
    $this->assertEquals(1, $crawler->filter('a:contains("Contactos")')->count());
  }
}
