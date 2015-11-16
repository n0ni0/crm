<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Entity\Repository;
use AppBundle\Entity\Comment;

class CommentManager
{
  protected $em;
  protected $repo;

  public function __construct(EntityManager $em)
  {
    $this->em         = $em;
    $this->repo       = $em->getRepository('AppBundle:Comment');
  }

  public function findComments($id)
  {
    return $this->repo->findByTask(
      array('id'           => $id),
      array('publishedAt' => 'DESC')
    );
  }

  public function findLastComment($id)
  {
    return $this->repo->findOneByTask(
      array('id'          => $id),
      array('publishedAt' => 'DESC')
    );
  }

  public function findLastEdit($id)
  {
    return $this->repo->findOneByTask(
      array('id'          => $id),
      array('editedAt' => 'DESC')
    );
  }

  public function checkUserComment($id)
  {
    $query = $this->repo->findOneById($id);

    return $query;
  }

  public function createComment($data, $flush = true)
  {
    $this->em->persist($data);
    if($flush){
      $this->em->flush();
    }
  }

  public function update()
  {
    $this->em->flush();
  }

  public function findAndDeleteComment($id)
  {
    return $this->repo->findAndDeleteComment($id);
  }

  public function checkIfDeleteComment($id)
  {
    $query   = $this->repo->findOneById($id);

    return $query;
  }

  public function findLastsComments($user)
  {
    return $this->repo->findLastsComments($user);
  }
}
