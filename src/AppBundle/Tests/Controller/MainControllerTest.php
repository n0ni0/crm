<?php

namespace AppBundle\Tests\Controller\MainController;

use AppBundle\Tests\Fixtures\AbstractTestCase;

class MainControllerTest extends AbstractTestCase
{
  public function testLoginPage()
  {
    $client = self::createClient();
    $client->request('GET', '/login');

    $this->assertTrue($client->getResponse()->isSuccessful());
  }

  public function testThatLoadHomeContent()
  {
    $crawler = $this->client->request('GET', '/');
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    $this->assertEquals(5, $crawler->filter('a.task')->count());
    $this->assertGreaterThan(2, $crawler->filter('a.public-note')->count());
    $this->assertGreaterThan(2, $crawler->filter('a.private-note')->count());
  }
}
