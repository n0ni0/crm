<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use AppBundle\Entity\Task;
use AppBundle\Entity\Comment;

class Comments extends AbstractFixture implements OrderedFixtureInterface
{
  public function getOrder(){
    return 80;
  }

  public function load(ObjectManager $manager)
  {
    $tasks = $manager->getRepository('AppBundle:Task')->findAll();
    $users = $manager->getRepository('AppBundle:User')->findAll();

    $testComment = new Comment();
    $testComment->setTask($tasks[0]);
    $testComment->setUser($users[0]);
    $testComment->setPublishedAt(new \DateTime('now - '.rand(1, 20).' days'));
    $testComment->setContent($this->getContents());

    $manager->persist($testComment);
    
    for ($i = 1; $i < 50; $i++) {
      $comments = new Comment();
      $user     = $users[array_rand($users)];
      $task     = $tasks[array_rand($tasks)];

      $comments->setTask($task);
      $comments->setUser($user);
      $comments->setPublishedAt(new \DateTime('now - '.rand(1, 20).' days'));
      $comments->setContent($this->getContents());

      $manager->persist($comments);
    }

    $manager->flush();
  }

  private function getContents()
  {
    $contents = array(
    'Quiere la boca exhausta vid, kiwi, piña y fugaz jamón. Fabio me exige, sin tapujos,
    que añada cerveza al whisky. Jovencillo emponzoñado de whisky, ¡qué figurota exhibes!
    La cigüeña tocaba cada vez mejor el saxofón y el búho pedía kiwi y queso.',
    'Reina en mi espíritu una alegría admirable, muy parecida a las dulces alboradas de la
    primavera, de que gozo aquí con delicia. Estoy solo, y me felicito de vivir en este país,
    el más a propósito para almas como la mía, soy tan dichoso, mi querido amigo,
    me sojuzga de tal modo la idea de reposar, que no me ocupo de mi arte'
   );

   return $contents[array_rand($contents)];
  }

}
