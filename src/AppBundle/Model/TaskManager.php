<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Entity\Repository;
use AppBundle\Entity\Task;

class TaskManager
{
  protected $em;
  protected $repo;

  public function __construct(EntityManager $em)
  {
    $this->em         = $em;
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

    return $query;
  }

  public function deleteTask($id)
  {
    return $this->repo->deleteTask($id);
  }

  public function update()
  {
    $this->em->flush();
  }
}
