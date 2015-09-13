<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{
  public function findAllTasks()
  {
    $em  = $this->getEntityManager();
    $dql = 'SELECT t,c,u,s
               FROM AppBundle:Task t
               JOIN t.taskCategory c
               JOIN t.user u
               JOIN t.state s';

    $query = $em->createQuery($dql);
    $query->execute();
    return $query->getResult();
  }
}
