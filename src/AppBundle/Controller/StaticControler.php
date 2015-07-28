<?php

namespace AppBundle\Controller;

Use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class StaticControler extends Controller
{
  /**
   * @Route("/privacy", name="privacy")
   */
  public function privacyAction()
  {
    return $this->render('static/privacy.html.twig');
  }
}
