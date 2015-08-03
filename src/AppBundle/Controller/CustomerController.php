<?php

namespace AppBundle\Controller;

Use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Customer;
use AppBundle\Entity\CustomerCategory;
use AppBundle\Entity\CustomerRepository;
use AppBundle\Utils\Constants;

class CustomerController extends Controller
{
  /**
   * @Route("/customer", name="customer")
   */
  public function listAction(Request $request)
  {
    $customer = $this->get('CustomerManager')->findAllCustomers();
    if(!$customer){
            throw $this->createNotFoundException(
                      'No se ha encontrado ningún cliente'
                    );
    }

    $paginator  = $this->get('knp_paginator');
    $customers = $paginator->paginate(
      $customer,
      $request->query->getInt('page',1), $pages = Constants::NUM_PAGES
    );

    return $this->render('customer/list.html.twig', array(
      'customers' => $customers
    ));
  }

  /**
   * @Route("/customer/{id}", name="customerProfile")
   */
  public function profileAction($id)
  {
    $profile = $this->get('CustomerManager')->findCustomerProfile($id);

    return $this->render('customer/customerProfile.html.twig', array(
      'profile' => $profile
    ));
  }
}
