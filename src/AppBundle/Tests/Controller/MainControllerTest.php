<?php

namespace AppBundle\Tests\Controller\MainController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends webTestCase
{
  public function testLoginPage()
  {
    $client = self::createClient();
    $client->request('GET', '/login');

    $this->assertTrue($client->getResponse()->isSuccessful());
  }
}
