<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class NotesRepository extends EntityRepository
{
  public function findPublicNotes($private)
  {
   $em  = $this->getEntityManager();
   $dql = 'SELECT n
             FROM AppBundle:Notes n
            WHERE n.private = :private';

   $query = $em->createQuery($dql);
   $query->setParameter('private', $private);
   $query->execute();
   return $query->getResult();
  }

  public function findPublicNotesMain($private)
  {
   $em  = $this->getEntityManager();
   $dql = 'SELECT n
             FROM AppBundle:Notes n
            WHERE n.private = :private';

   $query = $em->createQuery($dql);
   $query->setParameter('private', $private);
   $query->execute();
   $query->setMaxResults('5');
   return $query->getResult();
  }

  public function findPrivateNotes($user, $private)
  {
   $em  = $this->getEntityManager();
   $dql = 'SELECT n.title, n.id
              FROM AppBundle:Notes n
             WHERE n.user = :user
               AND n.private = :private';

   $query = $em->createQuery($dql);
   $query->setParameter('user', $user);
   $query->setParameter('private', $private);
   $query->execute();
   return $query->getResult();
  }

  public function findPrivateNotesMain($user, $private)
  {
   $em  = $this->getEntityManager();
   $dql = 'SELECT n.title, n.id
              FROM AppBundle:Notes n
             WHERE n.user = :user
               AND n.private = :private';

   $query = $em->createQuery($dql);
   $query->setParameter('user', $user);
   $query->setParameter('private', $private);
   $query->execute();
   $query->setMaxResults('5');
   return $query->getResult();
  }

  public function findAndDeleteNote($id)
  {
    $em = $this->getEntityManager();
    $dql = 'DELETE
              FROM AppBundle:Notes n
             WHERE n.id = :id';

    $query = $em->createQuery($dql);
    $query->setParameter('id', $id);
    $query->execute();
   }
}
