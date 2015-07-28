<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\CustomerCategory;

class CustomerCategories extends AbstractFixture implements OrderedFixtureInterface
{
  public function getOrder(){
    return 10;
  }

  public function load(ObjectManager $manager)
  {
    $categories = array(
      'test',
      'client',
      'maintenance',

    );

    foreach($categories as $newCustomerCategory)
    {
      $category = new CustomerCategory();
      $category->setCustomerCategory($newCustomerCategory);

      $manager->persist($category);
    }

    $manager->flush();
  }
}
