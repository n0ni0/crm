<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Entity\Repository;
use AppBundle\Entity\Calendar;

class CalendarManager
{
  protected $em;
  protected $repo;

  public function __construct(EntityManager $em)
  {
    $this->em         = $em;
    $this->repo       = $em->getRepository('AppBundle:Calendar');
  }

  public function checkUserPlanning($id)
  {
    $query = $this->repo->findOneByComment($id);

    return $query;
  }

  public function update()
  {
    $this->em->flush();
  }
}
