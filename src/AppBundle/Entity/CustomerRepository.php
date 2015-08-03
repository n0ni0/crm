<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CustomerRepository extends EntityRepository
{
  public function findAllCustomers()
  {
    return $this->getEntityManager()
      ->createQuery(
        'SELECT c
           FROM AppBundle:Customer c
          ORDER BY c.name ASC'
        )
      ->getResult();
  }

  public function findCustomerProfile($id)
  {
    $em  = $this->getEntityManager();
    $dql = 'SELECT c
              FROM AppBundle:Customer c
             WHERE c.id = :id';

    $query = $em->createQuery($dql);
    $query->setParameter('id', $id);

    return $query->getResult();
  }
}
