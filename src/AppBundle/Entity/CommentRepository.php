<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
  public function findAndDeleteComment($id)
  {
    $em = $this->getEntityManager();
    $dql = 'DELETE
              FROM AppBundle:Comment c
             WHERE c.id = :id';

    $query = $em->createQuery($dql);
    $query->setParameter('id', $id);
    $query->execute();
   }
}
