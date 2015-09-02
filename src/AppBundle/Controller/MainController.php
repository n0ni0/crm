<?php

namespace AppBundle\Controller;

Use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Notes;

class MainController extends Controller
{
  /**
   * @Route("/", name="main")
   */
  public function mainAction()
  {
    $user = $this->getUser()->getId();
    $publicNotes  = $this->get('NotesManager')->findNotes($user, $private = false);
    $privateNotes = $this->get('NotesManager')->findNotes($user, $private = true);

    return $this->render('main/main.html.twig', array(
      'publicNotes'  => $publicNotes,
      'privateNotes' => $privateNotes,
    ));
  }
}
