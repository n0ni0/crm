<?php

namespace AppBundle\Tests\Controller\NotesController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NotesControllerTest extends WebTestCase
{
  public function setUp()
  {
    $this->client = static::createClient(array(), array(
      'PHP_AUTH_USER' => 'username',
      'PHP_AUTH_PW'   => 'password',
    ));
  }

  public function testShowNote()
  {
    $crawler = $this->client->request('GET','/note/5');
    $this->assertCount(1, $crawler->filter('label:contains("Titulo")'),
      'The note have a label title.'
    );
  }

  public function testNewNoteCreate()
  {
    $crawler = $this->client->request('GET', '/note/new/');

    $this->assertEquals(1, $crawler->filter('h3:contains("Nueva nota")')->count());

    $form = $crawler->selectButton('Crear')->form();
    $form['app_note[title]']    = 'Nota creada en un test funcional';
    $form['app_note[private]']  = '0';
    $form['app_note[content]']  = 'C/Larga Nº14';

    $this->client->followRedirects(true);
    $crawler = $this->client->submit($form);
    $result  = $this->client->getResponse()->getStatusCode();
    $this->assertEquals($result, 200);
    $this->assertEquals(1, $crawler->filter('h3:contains("Página principal")')->count());
  }
}
