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

  public function findNotes($user, $private)
  {
    return $this->repo->findNotes($user, $private);
  }

  public function showNote($user, $id){
    return $this->repo->showNote($user,$id);
  }

  public function createNote($note, $flush = true)
  {
    $this->em->persist($note);
    if($flush){
      $this->em->flush();
    }
  }
}
