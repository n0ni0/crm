<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CalendarRepository extends EntityRepository
{
  public function findPlanning($id)
  {
    $conn= $this->getEntityManager()->getConnection();
    $sql = 'SELECT c.comment_id, u.username, c.start, c.end
              FROM calendar AS c
        INNER JOIN fos_user AS u ON (u.id = c.user_id)
             WHERE task_id = :task_id';

    $stmt = $conn->prepare($sql);
    $stmt->bindValue('task_id', $id);
    $stmt->execute();
    return $stmt;
  }
}
