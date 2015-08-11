<?php

namespace AppBundle\Tests\Controller\ContactController;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Utils\Constants;

class ContactControllerTest extends webTestCase
{
  public function setUp()
  {
    $this->client = static::createClient(array(), array(
      'PHP_AUTH_USER' => 'username',
      'PHP_AUTH_PW'   => 'password',
    ));
  }

  /**
   * Test if contact page show 20 contacts
   *
   */
  public function testIfLoadContacts()
  {
    $crawler = $this->client->request('GET', '/contact');
    $this->assertCount(
      Constants::CONTACTS_PER_PAGE,
      $crawler->filter('i.glyphicon-user'),
      'The contact page displays the correct number of contacts');
  }
}
