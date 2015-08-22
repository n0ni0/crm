<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class NotesRepository extends EntityRepository
{

  public function findAllPublicNotes()
  {
   $private = 0;

   $em  = $this->getEntityManager();
   $dql = 'SELECT n
             FROM AppBundle:Notes n
            WHERE n.private = :private';

   $query = $em->createQuery($dql);
   $query->setParameter('private', $private);
   $query->execute();
   return $query->getResult();
  }

  public function findUserPrivateNotes($user)
  {
    $private = 1;
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
}
