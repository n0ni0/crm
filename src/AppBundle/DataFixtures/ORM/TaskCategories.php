<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TaskCategories extends AbstractFixture implements OrderedFixtureInterface
{
  public function getOrder(){
    return 30;
  }

  public function load(ObjectManager $manager)
  {
    $categories = array(
      'project',
      'budget',
      'sat',
      'private'
    );

    foreach($categories as $newTaskCategory)
    {
      $category = new TaskCategory();
      $category->setTaskCategory($newTaskCategory);

      $manager->persist($category);
    }

    $manager->flush();
  }
}
