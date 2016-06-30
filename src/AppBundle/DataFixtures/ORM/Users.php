<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\User;

class Users extends AbstractFixture implements
  OrderedFixtureInterface, ContainerAwareInterface
{
  private $container;

  public function getOrder()
  {
    return 40;
  }

  public function setContainer(ContainerInterface $container = null)
  {
    $this->container = $container;
  }

  public function load(ObjectManager $manager)
  {
    $userManager = $this->container->get('fos_user.user_manager');

    $user = $userManager->createUser();
    $user->setUsername('username');
    $user->setEmail('user@crm.es');
    $user->setPlainPassword('password');
    $user->setEnabled(true);
    $user->setRoles(array('ROLE_USER'));

    $userManager->updateUser($user, true);

    $admin = $userManager->createUser();
    $admin->setUsername('admin');
    $admin->setEmail('admin@crm.es');
    $admin->setPlainPassword('admin');
    $admin->setEnabled(true);
    $admin->setRoles(array('ROLE_ADMIN'));

    $userManager->updateUser($admin, true);
  }
}
