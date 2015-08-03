<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\TaskCategory;
use AppBundle\Entity\User;
use AppBundle\Entity\State;
use AppBundle\Entity\Task;

class Tasks extends AbstractFixture implements OrderedFixtureInterface
{
  public function getOrder(){
    return 70;
  }

  public function load(ObjectManager $manager)
  {
    $users          = $manager->getRepository('AppBundle:User')->findAll();
    $states         = $manager->getRepository('AppBundle:State')->findAll();
    $taskCategories = $manager->getRepository('AppBundle:TaskCategory')->findAll();

    for ($i = 0; $i < 25; $i++) {
      $tasks        = new Task();
      $user         = $users[array_rand($users)];
      $state        = $states[array_rand($states)];
      $taskCategory = $taskCategories[array_rand($taskCategories)];

      $tasks->setTaskCategory($taskCategory);
      $tasks->setUser($user);
      $tasks->setTitle('Title'.$i);
      $tasks->setDescription('Description'.$i);
      $tasks->setState($state);
      $tasks->setStartTime(new \DateTime('now - '.rand(1, 20).' days'));

      $manager->persist($tasks);
    }

    $manager->flush();
  }


}
