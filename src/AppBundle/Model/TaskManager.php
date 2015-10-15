<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Entity\Repository;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use AppBundle\Entity\Task;

class TaskManager
{
  protected $em;
  protected $container;
  protected $repo;

  public function __construct(EntityManager $em, Container $container)
  {
    $this->em         = $em;
    $this->container  = $container;
    $this->repo       = $em->getRepository('AppBundle:Task');
  }

  public function findAllTasks()
  {
    return $this->repo->findAllTasks();
  }

  public function findTask($id)
  {
    return $this->repo->findOneById($id);
  }

  public function createTask($task, $flush = true)
  {
    $this->em->persist($task);
    if($flush){
      $this->em->flush();
    }
  }

  public function findTaskAndCheckUser($user, $id)
  {
    $query       = $this->repo->findOneById($id);
    $userTask    = $query->getUser()->getId();

    if($userTask == $user){
      return $query;
    }
  }

  public function deleteTask($id)
  {
    return $this->repo->deleteTask($id);
  }
}
