<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Notes;
use AppBundle\Form\Type\NoteType;

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

  /**
   * @Route("/note/new/", name="newNote")
   */
  public function newNoteAction(Request $request)
  {
    $notes = new Notes();
    $form = $this->createForm(new NoteType(), $notes);
    $form->handleRequest($request);

    if($form->isValid()){
      $data = $form->getData();
      $data->setUser($this->getUser());
      $this->get('NotesManager')->createNote($data);

      return $this->redirectToRoute('main');
    }

    return $this->render('notes/newNote.html.twig', array(
      'form' => $form->createView()
    ));
  }

  /**
   * @Route("/note/{id}/edit", name="editNote")
   */
  public function editNoteAction(Request $request, $id)
  {
    $user       = $this->getUser()->getId();
    $noteToEdit = $this->get('notesManager')->showNote($user, $id);

    if(!$noteToEdit){
      throw $this->createNotFoundException('Note not found or not allowed to edit');
    }

    $form = $this->createForm(new  NoteType(), $noteToEdit);
    $form->handleRequest($request);

    if($form->isValid()){
      $data = $form->getData();
      $data->setUser($this->getUser());
      $this->get('NotesManager')->update();

      return $this->redirectToRoute('note', array('id' => $noteToEdit->getId()));
    }

    return $this->render('notes/editNote.html.twig', array(
      'form' => $form->createView()
    ));
  }

  /**
   * @Route("/note/{id}/delete", name="deleteNote")
   */
  public function deleteNoteAction($id)
  {
    $user = $this->getUser()->getId();
    $note = $this->get('NotesManager')->showNote($user, $id);

    if(!$note){
      throw $this->createNotFoundException('Note not found or not allowed to delete');
    }

    $note = $this->get('NotesManager')->findAndDeleteNote($id);

    return $this->redirectToRoute('main');
  }
 }
