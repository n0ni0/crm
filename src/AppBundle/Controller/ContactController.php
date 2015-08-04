<?php

namespace AppBundle\Controller;

Use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Contact;
use AppBundle\Entity\ContactRepository;
use AppBundle\Utils\Constants;

class ContactController extends Controller
{
  /**
   * @Route("/contact", name="contact")
   */
  public function listAction(Request $request)
  {
    $contact = $this->get('ContactManager')->findAllContacts();
    if(!$contact){
            throw $this->createNotFoundException(
                      'No se ha encontrado ningún contacto'
                    );
    }

    $paginator  = $this->get('knp_paginator');
    $contacts = $paginator->paginate(
      $contact,
      $request->query->getInt('page',1), $pages = Constants::NUM_PAGES
    );

    return $this->render('contact/contactList.html.twig', array(
      'contacts' => $contacts
    ));
  }

  /**
   * @Route("/contact/{id}", name="contactProfile")
   */
  public function profileAction($id)
  {
    $profile = $this->get('ContactManager')->findContactProfile($id);

    return $this->render('contact/contactProfile.html.twig', array(
      'profile' => $profile
    ));
  }

  /**
   * @Route("/contact/{id}/delete", name="deleteContact")
   */
  public function deleteContactAction($id)
  {
    $contact = $this->get('ContactManager')->deleteContact($id);
    return $this->redirectToRoute('contact');
  }
}
