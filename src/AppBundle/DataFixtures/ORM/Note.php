<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Notes;
use AppBundle\Entity\User;

class Note extends AbstractFixture implements OrderedFixtureInterface
{
  public function getOrder()
  {
    return 50;
  }

  public function load(ObjectManager $manager)
  {
    $users = $manager->getRepository('AppBundle:User')->findAll();

    for ($i = 0; $i < 10; $i++) {
      $notes = new Notes();

      $priv = rand(0,1);
      $user = $users[array_rand($users)];
      $notes->setUser($user);
      $notes->setDate(new \DateTime('now - '.rand(1, 30).' days'));
      $notes->setContent($this->getComments());
      $notes->setPrivate($priv);

      $manager->persist($notes);
    }
    $manager->flush();
  }

  private function getComments()
  {
   $comments = array(
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit,  eiusmod tempor incididunt ut labore et
    dolore magna aliqua Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
    nisi ut aliquip ex ea commodo consequat',
    'Lorem ipsum dolor sit amet, consectetur adipisicing elit,  eiusmod tempor incididunt ut 
    labore et dolore magna aliqu Ut enim ad minim veniam, quis nostrud exercitation u commodo consequat'
   );

   return $comments[array_rand($comments)];
  }
}
