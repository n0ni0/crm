<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Notes;
use Appbundle\Form\Type\NotesType;

class NotesController extends Controller
{
  /**
   * @Route("/note/{id}", name="note")
   */
  public function showNoteAction($id, Request $request)
  {
    $user = $this->getUser()->getId();
    $note = $this->get('NotesManager')->showNote($user, $id);

    if(!$note){
      throw $this->createNotFoundException('Note not found');
    }

    return $this->render('notes/note.html.twig', array(
      'note' => $note
    ));

  }
}
