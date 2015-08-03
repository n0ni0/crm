<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Entity\Repository;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use AppBundle\Entity\Customer;

class CustomerManager
{
  protected $em;
  protected $container;
  protected $repo;

  public function __construct(EntityManager $em, Container $container)
  {
    $this->em         = $em;
    $this->container  = $container;
    $this->repo       = $em->getRepository('AppBundle:Customer');
  }

  public function findAllCustomers()
  {
    return $this->repo->findAllCustomers();
  }

  public function findCustomerProfile($id)
  {
    return $this->repo->findCustomerProfile($id);
  }

  public function deleteCustomer($customer)
  {
    return $this->repo->findAndDeleteCustomer($customer);
  }
}
