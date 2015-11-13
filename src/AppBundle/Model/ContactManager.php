<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Entity\Repository;
use AppBundle\Entity\Contact;

class ContactManager
{
  protected $em;
  protected $repo;

  public function __construct(EntityManager $em)
  {
    $this->em         = $em;
    $this->repo       = $em->getRepository('AppBundle:Contact');
  }

  public function findAllContacts($criteria)
  {
    return $this->repo->findBy(array(), array($criteria => 'ASC'));
  }

  public function findContactProfile($id)
  {
    return $this->repo->findContactProfile($id);
  }

  public function deleteContact($contact)
  {
    return $this->repo->findAndDeleteContact($contact);
  }

  public function findContact($id)
  {
    return $contact = $this->repo->find($id);
  }

  public function update()
  {
    $this->em->flush();
  }

  public function createContact($contact, $flush = true)
  {
    $this->em->persist($contact);
    if($flush){
      $this->em->flush();
    }
  }
}
