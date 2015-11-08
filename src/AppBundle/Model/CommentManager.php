<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Entity\Repository;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use AppBundle\Entity\Comment;

class CommentManager
{
  protected $em;
  protected $container;
  protected $repo;

  public function __construct(EntityManager $em, Container $container)
  {
    $this->em         = $em;
    $this->container  = $container;
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

  public function checkUserComment($user, $id)
  {
    $query       = $this->repo->findOneById($id);
    $userComment = $query->getUser()->getId();

    if($userComment == $user){
      return $query;
    }
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

  public function checkIfDeleteComment($user, $id)
  {
    $query   = $this->repo->findOneById($id);
    $comment = $query->getUser()->getId();

    if($user == $comment){
      return $query;
    }
  }

  public function findLastsComments($user)
  {
    return $this->repo->findLastsComments($user);
  }
}
