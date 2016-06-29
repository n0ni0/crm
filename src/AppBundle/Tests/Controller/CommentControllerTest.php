<?php


namespace AppBundle\Tests\Controller;


use AppBundle\Tests\Fixtures\AbstractTestCase;

class CommentControllerTest extends AbstractTestCase
{
    public function testNewComment()
    {
        $crawler = $this->client->request('GET','/task/1/content');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $link = $crawler->filter('a#comment-task')->link();
        $crawler = $this->client->click($link);

        $form = $crawler->selectButton('Añadir comentario')->form();
        $form['app_comment[content]'] = 'Comment test';

        $this->client->followRedirects(true);
        $crawler = $this->client->submit($form);

        $this->assertEquals(1, $crawler->filter('html:contains("Comment test")')->count());
    }

    public function testEditComment()
    {
        $crawler = $this->client->request('GET','/task/1/content');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $link = $crawler->filter('a#edit-comment')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $form = $crawler->selectButton('Editar comentario')->form();
        $form['app_comment[content]'] = 'Comment test edited';

        $this->client->followRedirects(true);
        $crawler = $this->client->submit($form);

        $this->assertEquals(1, $crawler->filter('html:contains("edited")')->count());
    }

    public function testDeleteComment()
    {
        $crawler = $this->client->request('GET','/task/1/content');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $link = $crawler->filter('a#delete-comment')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $this->assertEquals(1, $crawler->filter('html:contains("Tareas")')->count());
    }
}