<?php
namespace AppBundle\Tests\Controller;


use AppBundle\Tests\Fixtures\AbstractTestCase;

class TaskControllerTest extends AbstractTestCase
{
    public function testListTasks()
    {
        $crawler = $this->client->request('GET','/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $link = $crawler->filter('a:contains("Todas las tareas")')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $this->assertEquals(20, $crawler->filter('a.task')->count());
    }

    public function testShowTask()
    {
        $crawler = $this->client->request('GET','/task');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $link = $crawler->filter('a:contains("Next")')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $link = $crawler->filter('a:contains("Test tasks")')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $this->assertEquals(1, $crawler->filter('html:contains("Task description")')->count());
    }

    public function testNewTask()
    {
        $crawler = $this->client->request('GET','/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $link = $crawler->filter('a:contains("Nueva tarea")')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $form = $crawler->selectButton('Crear')->form();
        $form['app_task[title]']        = 'New task';
        $form['app_task[taskCategory]'] = "1";
        $form['app_task[state]']        = "1";
        $form['app_task[description]']  = 'Test task description';

        $this->client->followRedirects(true);
        $crawler = $this->client->submit($form);

        $this->assertEquals(1, $crawler->filter('html:contains("New task")')->count());
    }

    public function testEditTask()
    {
        $crawler = $this->client->request('GET','/task/1/content');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $link = $crawler->filter('a#edit-task')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $form = $crawler->selectButton('Editar tarea')->form();
        $form['app_task[title]']        = 'Edit task';
        $form['app_task[taskCategory]'] = "3";
        $form['app_task[state]']        = "2";
        $form['app_task[description]']  = 'Test task description edited';

        $this->client->followRedirects(true);
        $crawler = $this->client->submit($form);

        $this->assertEquals(1, $crawler->filter('html:contains("edited")')->count());
    }

    public function testDeleteTask()
    {
        $crawler = $this->client->request('GET','/task/1/content');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $link = $crawler->filter('a#delete-task')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $this->assertEquals(1, $crawler->filter('html:contains("Tareas")')->count());
    }
}