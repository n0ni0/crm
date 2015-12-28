<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\PlanningType;
use AppBundle\Security\CommentVoter;
use AppBundle\Entity\Task;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Calendar;

class CalendarController extends Controller
{
  /**
   * @route("/calendar", name="calendar")
   *
   */
  public function showCalendarAction()
  {
    return $this->render('calendar/calendar.html.twig');
  }

  /**
   * @Route("/task/{task}/comment/{id}/planning/", name="planningComment")
   * @ParamConverter("task", class="AppBundle:Task")
   */
  public function planninCommentAction(Request $request, Task $task, Comment $id)
  {
    $calendar = new Calendar();

    $planning= $this->get('CalendarManager')->checkUserPlanning($id);

    if($planning){
      $this->addFlash(
        'success',
        'El comentario ya está planificado'
      );
      return $this->redirect($request->headers->get('referer'));
    }

    $commentToPlanning = $this->get('CommentManager')->checkUserComment($id);

    if(!$this->isGranted(CommentVoter::ATTRIBUTE_MODIFY, $commentToPlanning)){
      throw $this->createAccessDeniedException('Comment not found or not allowed to edit');
    }

    $form = $this->createForm(new PlanningType(), $calendar);
    $form->handleRequest($request);

    if($form->isValid()){
      $data = $form->getData();
      $data->setTitle($task->getTitle());
      $data->setTask($task);
      $data->setComment($id);
      $this->get('CommentManager')->createComment($data);

      $id = $task->getId();
      return $this->redirectToRoute('task', array(
        'id' => $task->getId()));
    }

    return $this->render('comments/planningComment.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  /**
   * @Route("/task/{task}/comment/{id}/planning/edit/", name="editPlanningComment")
   * @ParamConverter("task", class="AppBundle:Task")
   * @ParamConverter("comment", class="AppBundle:Comment")
   */
  public function editPlanningCommentAction(Request $request, Task $task, Comment $id)
  {
    $planningToEdit = $this->get('CalendarManager')->checkUserPlanning($id);

    if(!$planningToEdit){
      $this->addFlash(
        'success',
        'No se ha planificado ningún comentario'
      );
      return $this->redirect($request->headers->get('referer'));
    }

    $form = $this->createForm(new PlanningType(), $planningToEdit);
    $form->handleRequest($request);

    if($form->isValid()){
      $this->get('CalendarManager')->update();

      return $this->redirectToRoute('task', array(
        'id' => $task->getId()));
    }

    return $this->render('comments/planningComment.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}
