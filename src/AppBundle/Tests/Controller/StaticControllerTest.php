<?php

namespace AppBundle\Tests\Controller\StaticController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StaticControllerTest extends webTestCase
{
  public function testPrivacy()
  {
    $client = self::createClient();
    $client->request('GET', '/privacy');

    $this->assertTrue($client->getResponse()->isSuccessful());
  }
}
