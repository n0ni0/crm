<?php

namespace AppBundle\Tests\Controller;


use AppBundle\Tests\Fixtures\AbstractTestCase;

class UserControllerTest extends AbstractTestCase
{
    public function testRoleAdminCanListUsers()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'admin',
        ));

        $crawler = $this->client->request('GET','/users/list');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testRoleUserCantListUsers()
    {
        $crawler = $this->client->request('GET','/users/list');
        $this->assertEquals($this->client->getResponse()->getStatusCode(), 403);
    }

    public function testRoleAdminCanDeleteUsers()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'admin',
        ));

        $crawler = $this->client->request('GET','/users/list');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $link = $crawler->filter('a.btn-danger')->link();
        $this->client->followRedirects(true);
        $crawler = $this->client->click($link);

        $this->assertEquals(0, $crawler->filter('html:contains("username")')->count());
    }
}