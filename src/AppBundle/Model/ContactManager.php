<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Entity\Repository;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use AppBundle\Entity\Contact;

class ContactManager
{
  protected $em;
  protected $container;
  protected $repo;

  public function __construct(EntityManager $em, Container $container)
  {
    $this->em         = $em;
    $this->container  = $container;
    $this->repo       = $em->getRepository('AppBundle:Contact');
  }

  public function findAllContacts()
  {
    return $this->repo->findAll();
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

}
