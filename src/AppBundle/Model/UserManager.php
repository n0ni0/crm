<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Entity\Repository;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use AppBundle\Entity\User;

class UserManager
{
  protected $em;
  protected $container;
  protected $repo;

  public function __construct(EntityManager $em, Container $container)
  {
    $this->em         = $em;
    $this->container  = $container;
    $this->repo       = $em->getRepository('AppBundle:User');
  }

  public function findAllUsers()
  {
    return $this->repo->findAll();
  }

  public function deleteUser($id)
  {
    return $this->repo->findAndDeleteUser($id);
  }
}
