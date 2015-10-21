<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\State;

class States extends AbstractFixture implements OrderedFixtureInterface
{
  public function getOrder(){
    return 20;
  }

  public function load(ObjectManager $manager)
  {
    $states = array(
      'En curso',
      'Cerrada',
      'A la espera'
    );

    foreach($states as $newState)
    {
      $state = new State();
      $state->setState($newState);

      $manager->persist($state);
    }

    $manager->flush();
  }
}
