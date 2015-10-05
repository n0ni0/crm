<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Utils\Constants;

class TaskController extends Controller
{
  /**
   * @Route("/task", name="listTask")
   */
  public function listAction(Request $request)
  {
    $task = $this->get('TaskManager')->findAllTasks();

    if(!$task){
      throw $this->createNotFoundException('Task not found');
    }

      $paginator  = $this->get('knp_paginator');
      $tasks   = $paginator->paginate(
      $task,
      $request->query->getInt('page',1), $pages = Constants::CONTACTS_PER_PAGE
      );
    return $this->render('tasks/taskList.html.twig', array(
      'task'  => $task,
      'tasks' => $tasks
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

    $taskId      = $task->getId();
    $comment     = $this->get('CommentManager')->findComments($taskId);
    $lastComment = $this->get('CommentManager')->findLastComment($taskId);
    $lastEdit    = $this->get('CommentManager')->findLastEdit($taskId);

    return $this->render('tasks/task.html.twig', array(
      'task'        => $task,
      'lastComment' => $lastComment,
      'lastEdit'    => $lastEdit,
      'comment'     => $comment
    ));
  }
}
