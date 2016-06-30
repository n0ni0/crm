<?php

namespace AppBundle\Tests\Controller\StaticController;

use AppBundle\Tests\Fixtures\AbstractTestCase;

class StaticControllerTest extends AbstractTestCase
{
  public function testPrivacy()
  {
    $this->client->request('GET', '/privacy');

    $this->assertTrue($this->client->getResponse()->isSuccessful());
  }
}
