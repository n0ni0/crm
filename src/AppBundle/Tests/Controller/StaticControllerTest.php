<?php

namespace AppBundle\Tests\Controller\StaticController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StaticControllerTest extends webTestCase
{
  public function setUp()
  {
    $this->client = static::createClient(array(), array(
      'PHP_AUTH_USER' => 'username',
      'PHP_AUTH_PW'   => 'password',
    ));
  }

  public function testPrivacy()
  {
    $this->client->request('GET', '/privacy');

    $this->assertTrue($this->client->getResponse()->isSuccessful());
  }
}
