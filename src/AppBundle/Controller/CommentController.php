<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\CommentType;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Task;
use AppBundle\Security\CommentVoter;

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

  /**
   * @Route("/task/{task}/comment/{id}/", name="editComment")
   */
  public function editCommentAction(Request $request, $id, $task)
  {
    $commentToEdit = $this->get('CommentManager')->checkUserComment($id);

    if(!$this->isGranted(CommentVoter::ATTRIBUTE_MODIFY, $commentToEdit)){
      throw $this->createAccessDeniedException('Comment not found or not allowed to edit');
    }

    $form = $this->createForm(new  CommentType(), $commentToEdit);
    $form->handleRequest($request);

    if($form->isValid()){
      $now  = new \DateTime();
      $data = $form->getData();
      $data->setEditedAt($now);
      $this->get('CommentManager')->update();

      return $this->redirectToRoute('task', array(
        'id' => $task));
    }

    return $this->render('comments/editComment.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  /**
   * @Route("task/{task}/comment/{id}/delete", name="deleteComment")
   */
  public function deleteCommentAction($id, $task)
  {
    $comment = $this->get('CommentManager')->checkIfDeleteComment($id);

    if(!$this->isGranted(CommentVoter::ATTRIBUTE_MODIFY, $comment)){
      throw $this->createNotFoundException('Comment not found or not allowed to delete');
    }

    $comment = $this->get('CommentManager')->findAndDeleteComment($id);

    return $this->redirectToRoute('task', array(
      'id' => $task));
  }

}
