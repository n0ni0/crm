<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Entity\Repository;
use AppBundle\Entity\User;

class UserManager
{
  protected $em;
  protected $repo;

  public function __construct(EntityManager $em)
  {
    $this->em         = $em;
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
