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
}
