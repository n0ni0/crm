<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Tests\Fixtures\AbstractTestCase;
use AppBundle\Utils\Constants;

class ContactControllerTest extends AbstractTestCase
{
  /**
   * Test if contact page show 20 contacts
   *
   */
  public function testIfLoadContacts()
  {
    $crawler = $this->client->request('GET', '/contact');
    $this->assertCount(
      Constants::CONTACTS_PER_PAGE,
      $crawler->filter('a.contact'),
      'The contact page displays the correct number of contacts');
  }

  public function testLoadUserProfile()
  {
    $crawler = $this->client->request('GET', '/contact/1');
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    $this->assertEquals(1, $crawler->filter('html:contains("User")')->count());
    $this->assertEquals(1, $crawler->filter('html:contains("Test")')->count());
    $this->assertEquals(1, $crawler->filter('html:contains("calle test")')->count());
    $this->assertEquals(1, $crawler->filter('html:contains("Villatest")')->count());
    $this->assertEquals(1, $crawler->filter('html:contains("956666666")')->count());
    $this->assertEquals(1, $crawler->filter('html:contains("666666666")')->count());
    $this->assertEquals(1, $crawler->filter('html:contains("test@crm.local")')->count());
    $this->assertEquals(1, $crawler->filter('html:contains("testCompany")')->count());
    $this->assertEquals(1, $crawler->filter('html:contains("Test annotation")')->count());
  }

  public function testNewContactCreate()
  {
    $crawler = $this->client->request('POST', '/contact/new/');

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

  public function testEditContact()
  {
    $crawler = $this->client->request('POST', '/contact/1/edit');
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    $form = $crawler->selectButton('Editar contacto')->form();
    $form['app_ContactProfile[name]']        = 'Ana';
    $form['app_ContactProfile[lastname]']    = 'Aragón';
    $form['app_ContactProfile[address]']     = 'C/Chica Nº10';
    $form['app_ContactProfile[city]']        = 'San Fernando';
    $form['app_ContactProfile[phone]']       = '956234567';
    $form['app_ContactProfile[mobilephone]'] = '677898933';
    $form['app_ContactProfile[email]']       = 'ana@gmail.com';
    $form['app_ContactProfile[company]']     = 'edit test company';
    $form['app_ContactProfile[annotations]'] = 'edit test annotation';

    $this->client->followRedirects(true);
    $crawler = $this->client->submit($form);

    $this->assertEquals(1, $crawler->filter('html:contains("Ana")')->count());
  }

  public function testDeleteContact()
  {
    $crawler = $this->client->request('POST', '/contact/1');
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    $link = $crawler->filter('a.btn-danger')->link();
    $this->client->followRedirects(true);
    $crawler = $this->client->click($link);

    $this->assertEquals(1, $crawler->filter('html:contains("Contactos")')->count());
  }
}
