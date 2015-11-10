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
    $user         = $this->getUser()->getId();
    $publicNotes  = $this->get('NotesManager')->findPublicNotesMain($private = false);
    $privateNotes = $this->get('NotesManager')->findPrivateNotesMain($user, $private = true);
    $lastComments = $this->get('CommentManager')->findLastsComments($user);

    return $this->render('main/main.html.twig', array(
      'publicNotes'  => $publicNotes,
      'privateNotes' => $privateNotes,
      'lastComments' => $lastComments,
    ));
  }
}
