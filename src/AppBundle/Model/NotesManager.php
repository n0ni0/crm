<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Entity\Repository;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use AppBundle\Entity\Notes;

class NotesManager
{
  protected $em;
  protected $container;
  protected $repo;

  public function __construct(EntityManager $em, Container $container)
  {
    $this->em         = $em;
    $this->container  = $container;
    $this->repo       = $em->getRepository('AppBundle:Notes');
  }

  public function findAllPublicNotes()
  {
    return $this->repo->findAllPublicNotes();
  }

  public function findUserPrivateNotes($user)
  {
    return $this->repo->findUserPrivateNotes($user);
  }
}
