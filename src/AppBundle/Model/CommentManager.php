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

  public function findLast($id)
  {
    return $this->repo->findOneByTask(
      array('id'          => $id),
      array('publishedAt' => 'DESC')
    );
  }
}
