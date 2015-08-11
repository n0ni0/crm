<?php

namespace AppBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ContactRepositoryTest extends kernelTestCase
{
  /**
   * @var \Doctrine\ORM\EntityManager
   */
  private $em;

  public function setUp()
  {
    self::bootKernel();
    $this->em = static::$kernel->getContainer()
      ->get('doctrine')
      ->getManager();
  }

  public function testFindContactProfile()
  {
    $contacts = $this->em
      ->getRepository('AppBundle:Contact')
      ->findContactProfile('5');

    $this->assertCount(1, $contacts);
  }

  public function testFindAndDeleteContact()
  {
    $contacts = $this->em
     ->getRepository('AppBundle:Contact')
     ->findAndDeleteContact('5');
  }
}
