<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
  public function findAllUsers()
  {
    $em  = $this->getEntityManager();
    $dql = 'SELECT u
              FROM AppBundle:User u';

    $query = $em->createQuery($dql);
    $query->execute();
    return $query->getResult();
  }
}
