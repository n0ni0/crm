<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{
  /**
   * @Route("/task", name="listTask")
   */
  public function listAction()
  {
    $task = $this->get('TaskManager')->findAllTasks();

    if(!$task){
      throw $this->createNotFoundException('Task not found');
    }
    return $this->render('tasks/taskList.html.twig', array(
      'task' => $task
    ));
  }

  /**
   * @Route("/task/{id}/", name="task")
   */
  public function showTaskAction($id, Request $request)
  {
    $task = $this->get('TaskManager')->findTask($id);

    if(!$task){
      throw $this->createNotFoundException('Task not found');
    }

    $taskId  = $task->getId();
    $comment = $this->get('CommentManager')->findComments($taskId);
    $last    = $this->get('CommentManager')->findLast($taskId);

    return $this->render('tasks/task.html.twig', array(
      'task'    => $task,
      'last'    => $last,
      'comment' => $comment
    ));
  }
}
