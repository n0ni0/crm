<?php

namespace AppBundle\EventListener;

use AppBundle\CrmEvents;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\TranslatorInterface;

class FlashMessagesListener extends Event
{
  private $session;
  private $translator;

  public function __construct(Session $session, TranslatorInterface $translator )
  {
    $this->session    = $session;
    $this->translator = $translator;
  }

  public function onNewUserCreated()
  {
    return $this->session->getFlashBag()->add('success', $this->translator->trans('flash.user_created'));
  }
}
