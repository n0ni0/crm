<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class NotesRepository extends EntityRepository
{
  public function findNotes($user, $private)
  {
   $em  = $this->getEntityManager();
   $dql = 'SELECT n
             FROM AppBundle:Notes n
             WHERE n.user = :user
               AND n.private = :private';

   $query = $em->createQuery($dql);
   $query->setParameter('user', $user);
   $query->setParameter('private', $private);
   $query->execute();
   return $query->getResult();
  }

  public function showNote($user, $id)
  {
    $em  = $this->getEntityManager();
    $dql = 'SELECT n,u
              FROM AppBundle:Notes n
              JOIN n.user u
             WHERE n.user = :user
               AND n.id = :id';

    $query = $em->createQuery($dql);
    $query->setParameter('user', $user);
    $query->setParameter('id', $id);
    $query->execute();
    return $query->getOneorNullResult();
  }
}
