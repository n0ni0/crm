<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Utils\Constants;
use AppBundle\Entity\Task;
use AppBundle\Form\Type\TaskType;

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
   * @Route("/task/{id}/content", name="task")
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

  /**
   * @Route("/task/new/", name="newTask")
   */
  public function newTaskAction(Request $request)
  {
    $task = new Task();
    $form = $this->createForm(new TaskType(), $task);
    $form->handleRequest($request);

    if($form->isValid()){
      $data = $form->getData();
      $data->setUser($this->getUser());
      $this->get('TaskManager')->createTask($data);

      return $this->redirectToRoute('listTask');
    }

    return $this->render('contact/newContact.html.twig', array(
      'form' => $form->createView()
    ));
  }

  /**
   * @Route("/task/{id}/delete", name="deleteTask")
   */
  public function deleteTaskAction($id)
  {
    $user = $this->getUser()->getId();
    $task = $this->get('TaskManager')->findTaskAndCheckUser($user, $id);

    if(!$task){
      throw $this->createNotFoundException('Task not found or not allowed to delete');
    }

    $note = $this->get('TaskManager')->DeleteTask($id);

    return $this->redirectToRoute('listTask');
  }

  /**
   * @Route("/task/{id}/edit", name="editTask")
   */
  public function editTaskAction(Request $request, $id)
  {
    $user = $this->getUser()->getId();
    $task = $this->get('TaskManager')->findTaskAndCheckUser($user, $id);

    if(!$task){
      throw $this->createNotFoundException('Task not found or not allowed to delete');
    }

    $form = $this->createForm(new  TaskType(), $task);
    $form->handleRequest($request);

    if($form->isValid()){
      $this->get('TaskManager')->update();

      return $this->redirectToRoute('task', array(
        'id' => $id));
    }

    return $this->render('tasks/editTask.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}
