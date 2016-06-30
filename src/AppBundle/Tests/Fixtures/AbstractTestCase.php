<?php

namespace AppBundle\Tests\Fixtures;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AbstractTestCase extends WebTestCase
{
    /** @var Client */
    protected $client;
    protected function setUp()
    {
        $this->initClient();
        $this->initDatabase();
    }

    protected function tearDown()
    {
        $this->client = null;
    }

    protected function initClient()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'username',
            'PHP_AUTH_PW'   => 'password',
        ));
    }

    /**
     * It ensures that the database contains the original fixtures of the
     * application. This way tests can modify its contents safely without
     * interfering with subsequent tests.
     */
    protected function initDatabase()
    {
        $buildDir = 'build/';
        copy($buildDir.'/original_test.db', $buildDir.'/test.db');
    }
}