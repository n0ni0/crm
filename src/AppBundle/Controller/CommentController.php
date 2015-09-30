<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\CommentType;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Task;

class CommentController extends Controller
{
  /**
   * @Route("/task/{task}/comment", name="newComment")
   * @ParamConverter("task", class="AppBundle:Task")
   */
  public function newCommentAction(Request $request,Task $task)
  {
    $comment = new Comment();
    $form    = $this->createForm(new CommentType(), $comment);
    $form->handleRequest($request);

    if($form->isValid()){
      $data = $form->getData();
      $data->setUser($this->getUser());
      $data->setTask($task);
      $this->get('CommentManager')->createComment($data);

      $id = $task->getId();
      return $this->redirectToRoute('task', array(
        'id' => $id));
    }

    return $this->render('comments/newComment.html.twig', array(
      'task' => $task,
      'form' => $form->createView()
    ));
  }

  /**
   * @param Task $task
   * @return Response
   */
  public function commentFormAction(Task $task)
  {
    $form = $this->createForm(new CommentType());

    return $this->render('comments/newComment.html.twig', array(
      'task' => $task,
      'form' => $form->createView(),
    ));
  }
}
