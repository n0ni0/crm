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
               JOIN t.state s
           ORDER BY t.id DESC';

    $query = $em->createQuery($dql);
    $query->execute();
    return $query->getResult();
  }

  public function deleteTask($id)
  {
    $em = $this->getEntityManager();
    $dql = 'DELETE
              FROM AppBundle:Task t
             WHERE t.id = :id';

    $query = $em->createQuery($dql);
    $query->setParameter('id', $id);
    $query->execute();
   }
}
