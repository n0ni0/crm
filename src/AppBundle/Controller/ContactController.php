<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Contact;
use AppBundle\Entity\ContactRepository;
use AppBundle\Utils\Constants;
use AppBundle\Form\Type\ContactProfileType;
use AppBundle\Form\Type\ContactListType;

class ContactController extends Controller
{
  /**
   * @Route("/contact", name="contact")
   */
  public function listAction(Request $request)
  {
    $form = $this->createForm(new ContactListType());
    $form->handleRequest($request);

    if($form->isValid()){
      $criteria = $form->get('contact')->getData();
      $contact  = $this->get('ContactManager')->findAllContacts($criteria);

      $paginator  = $this->get('knp_paginator');
      $contacts   = $paginator->paginate(
      $contact,
      $request->query->getInt('page',1), $pages = Constants::CONTACTS_PER_PAGE
      );

      return $this->render('contact/contactList.html.twig', array(
        'contacts' => $contacts,
        'form'     => $form->createView()
        ));
     }

    $contact  = $this->get('ContactManager')
      ->findAllContacts($criteria = Constants::DEFAULT_CONTACT_ORDER);

    $paginator  = $this->get('knp_paginator');
    $contacts = $paginator->paginate(
      $contact,
      $request->query->getInt('page',1), $pages = Constants::CONTACTS_PER_PAGE
    );

    return $this->render('contact/contactList.html.twig', array(
      'contacts' => $contacts,
      'form'     => $form->createView()
    ));
  }

  /**
   * @Route("/contact/{id}", name="contactProfile")
   */
  public function profileAction($id)
  {
    $profile = $this->get('ContactManager')->findContactProfile($id);

    if(!$profile){
      throw $this->createNotFoundException('Usuario no encontrado');
    }

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

  /**
   * @Route("/contact/{id}/edit", name="editContact")
   */
  public function editContactAction(Request $request, $id)
  {
    $contact = $this->get('ContactManager')->findContact($id);

    if(!$contact){
      throw $this->createNotFoundException('Usuario no encontrado');
    }

    $form = $this->createForm(new ContactProfileType(), $contact);
    $form->handleRequest($request);

    if($form->isValid()){
      $this->get('ContactManager')->update();

      return $this->redirectToRoute('contactProfile', array('id' => $contact->getId()));
    }

    return $this->render('contact/editContactProfile.html.twig', array(
      'form' => $form->createView()
    ));
  }

  /**
   * @Route("/contact/new/", name="newContact")
   */
  public function newContactAction(Request $request)
  {
    $contact = new Contact();
    $form    = $this->createForm(new ContactProfileType(), $contact);
    $form->handleRequest($request);

    if($form->isValid()){
        $this->get('ContactManager')->createContact($contact);

      return $this->redirectToRoute('contactProfile', array('id' => $contact->getId()));
    }

    return $this->render('contact/newContact.html.twig', array(
      'form' => $form->createView()
    ));
  }
}
