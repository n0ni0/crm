<?php

namespace AppBundle\Controller;

Use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MainController extends Controller
{
  /**
   * @Route("/", name="main")
   */
  public function privacyAction()
  {
    return $this->render('main/main.html.twig');
  }
}
