<?php

namespace AppBundle\Controller;

Use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Customer;
use AppBundle\Entity\CustomerRepository;

class CustomerController extends Controller
{
  /**
   * @Route("/customer", name="customer")
   */
  public function listAction()
  {
    $customer = $this->get('CustomerManager')->findAllCustomers();
    if(!$customer){
            throw $this->createNotFoundException(
                      'No se ha encontrado ningún cliente'
                    );
    }

    $paginator  = $this->get('knp_paginator');
    $pagination = $paginator->paginate(
      $customer,
      $this->getRequest()->query->get('page',1),15
    );

    return $this->render('customer/list.html.twig', compact(
      'pagination'
    ));
  }
}
