<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
}
