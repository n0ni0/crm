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

  public function findPublicNotes($private)
  {
    return $this->repo->findPublicNotes($private);
  }

  public function findPrivateNotes($user, $private)
  {
    return $this->repo->findPrivateNotes($user, $private);
  }

  public function showNote($user, $id){
    $query       = $this->repo->findOneById($id);
    $userNote    = $query->getUser()->getId();
    $privateNote = $query->getPrivate();

    if($userNote != $user && $privateNote == true){
      return false;
    }
    else{
      return $query;
    }
  }

  public function createNote($note, $flush = true)
  {
    $this->em->persist($note);
    if($flush){
      $this->em->flush();
    }
  }

  public function update()
  {
    $this->em->flush();
  }

  public function findAndDeleteNote($id)
  {
    return $this->repo->findAndDeleteNote($id);
  }
}
