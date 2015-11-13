<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Entity\Repository;
use AppBundle\Entity\Notes;

class NotesManager
{
  protected $em;
  protected $repo;

  public function __construct(EntityManager $em)
  {
    $this->em         = $em;
    $this->repo       = $em->getRepository('AppBundle:Notes');
  }

  public function findPublicNotes($private)
  {
    return $this->repo->findPublicNotes($private);
  }

  public function findPublicNotesMain($private)
  {
    return $this->repo->findPublicNotesMain($private);
  }

  public function findPrivateNotes($user, $private)
  {
    return $this->repo->findPrivateNotes($user, $private);
  }

  public function findPrivateNotesMain($user, $private)
  {
    return $this->repo->findPrivateNotesMain($user, $private);
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
