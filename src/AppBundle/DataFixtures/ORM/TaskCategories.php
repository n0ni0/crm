<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\TaskCategory;

class TaskCategories extends AbstractFixture implements OrderedFixtureInterface
{
  public function getOrder(){
    return 30;
  }

  public function load(ObjectManager $manager)
  {
    $categories = array(
      'Proyecto',
      'Presupuesto',
      'Sat',
      'Privada'
    );


    foreach($categories as $TaskCategories)
    {
      $categories = new TaskCategory();
      $categories->setTaskCategory($TaskCategories);

      $manager->persist($categories);
    }

      $manager->flush();
  }
}
