<?php

namespace AppBundle\Tests\Controller\NotesController;

use AppBundle\Tests\Fixtures\AbstractTestCase;

class NotesControllerTest extends AbstractTestCase
{
  public function testShowNote()
  {
    $crawler = $this->client->request('GET','/note/1');
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    $this->assertEquals(1, $crawler->filter('html:contains("Test note")')->count());
  }

  public function testNewNoteCreate()
  {
    $crawler = $this->client->request('GET', '/');
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    $link = $crawler->filter('a:contains("Nueva nota")')->link();
    $this->client->followRedirects(true);
    $crawler = $this->client->click($link);

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

  public function testEditNote()
  {
    $crawler = $this->client->request('POST', '/note/1');
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    $link = $crawler->filter('a.btn-success')->link();
    $this->client->followRedirects(true);
    $crawler = $this->client->click($link);

    $form = $crawler->selectButton('Editar nota')->form();
    $form['app_note[title]']    = 'Nota editada en un test funcional';
    $form['app_note[private]']  = '0';
    $form['app_note[content]']  = 'C/Larga Nº14';

    $this->client->followRedirects(true);
    $crawler = $this->client->submit($form);

    $this->assertEquals(1, $crawler->filter('html:contains("Nota editada en un test funcional")')->count());
  }

  public function testDeleteNote()
  {
    $crawler = $this->client->request('POST', '/note/1');
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    $link = $crawler->filter('a.btn-danger')->link();
    $this->client->followRedirects(true);
    $crawler = $this->client->click($link);

    $this->assertEquals(1, $crawler->filter('html:contains("Página principal")')->count());
  }

  public function testListPublicNotes()
  {
    $crawler = $this->client->request('GET', '/');
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    $link = $crawler->filter('a:contains("Notas públicas")')->link();
    $this->client->followRedirects(true);
    $crawler = $this->client->click($link);

    $this->assertEquals(1, $crawler->filter('html:contains("Notas públicas")')->count());
    $this->assertGreaterThan(1, $crawler->filter('a.public-note')->count());
  }

  public function testListPrivateNotes()
  {
    $crawler = $this->client->request('GET', '/');
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    $link = $crawler->filter('a:contains("Notas privadas")')->link();
    $this->client->followRedirects(true);
    $crawler = $this->client->click($link);

    $this->assertEquals(1, $crawler->filter('html:contains("Notas privadas")')->count());
    $this->assertGreaterThan(1, $crawler->filter('a.private-note')->count());
  }
}
