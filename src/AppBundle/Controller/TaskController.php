<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\TaskRepository;
use AppBundle\Entity\Task;

class TaskController extends Controller
{
  /**
   * @Route("/task", name="listTask")
   */
  public function listAction()
  {
    $task = $this->get('TaskManager')->findAllTasks();

    if(!$task){
      throw $this->createNotFoundException('Usuario no encontrado');
    }
    return $this->render('tasks/taskList.html.twig', array(
      'task' => $task
    ));
  }
}
