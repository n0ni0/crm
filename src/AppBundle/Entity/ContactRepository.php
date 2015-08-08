<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ContactRepository extends EntityRepository
{
  public function findContactProfile($id)
  {
    $em  = $this->getEntityManager();
    $dql = 'SELECT c
              FROM AppBundle:Contact c
             WHERE c.id = :id';

    $query = $em->createQuery($dql);
    $query->setParameter('id', $id);
    $query->execute();
    return $query->getResult();
  }

  public function findAndDeleteContact($id)
  {
    $em = $this->getEntityManager();
    $dql = 'DELETE
              FROM AppBundle:Contact c
             WHERE c.id = :id';

    $query = $em->createQuery($dql);
    $query->setParameter('id', $id);
    $query->execute();
   }
}
