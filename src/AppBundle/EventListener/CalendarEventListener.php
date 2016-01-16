<?php
namespace AppBundle\EventListener;

use ADesigns\CalendarBundle\Event\CalendarEvent;
use ADesigns\CalendarBundle\Entity\EventEntity;
use Doctrine\ORM\EntityManager;

class CalendarEventListener
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

   public function loadEvents(CalendarEvent $calendarEvent)
    {
      $startDate = $calendarEvent->getStartDateTime();
      $endDate   = $calendarEvent->getEndDateTime();

      $companyEvents = $this->entityManager->getRepository('AppBundle:Calendar')
                        ->createQueryBuilder('c')
                        ->where('c.start BETWEEN :startDate and :endDate')
                        ->setParameter('startDate', $startDate)
                        ->setParameter('endDate', $endDate)
                        ->getQuery()->getResult();

      foreach($companyEvents as $companyEvent) {
        $eventEntity = new EventEntity($companyEvent->getTitle(),
                                       $companyEvent->getStart(), 
                                       $companyEvent->getEnd());
        $eventEntity->setBgColor('red');

        $calendarEvent->addEvent($eventEntity);
      }
    }
}
