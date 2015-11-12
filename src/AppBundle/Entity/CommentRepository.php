<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
  public function findAndDeleteComment($id)
  {
    $em = $this->getEntityManager();
    $dql = 'DELETE
              FROM AppBundle:Comment c
             WHERE c.id = :id';

    $query = $em->createQuery($dql);
    $query->setParameter('id', $id);
    $query->execute();
   }

  public function findLastsComments($user)
  {
    $conn= $this->getEntityManager()->getConnection();
    $sql = 'SELECT c.publishedAt, t.id, t.title, s.state, a.task_category
              FROM comment AS c
        INNER JOIN task AS t ON (t.id = c.task_id)
        INNER JOIN state AS s ON (t.state_id = s.id)
        INNER JOIN task_category AS a ON (t.task_category_id = a.id)
             WHERE c.user_id = :user
          ORDER BY c.publishedAt DESC
             LIMIT 5';

    $stmt = $conn->prepare($sql);
    $stmt->bindValue('user', $user);
    $stmt->execute();
    return $stmt;
  }
}
