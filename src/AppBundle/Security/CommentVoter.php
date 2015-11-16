<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class CommentVoter extends AbstractVoter
{
  const ATTRIBUTE_MODIFY = 'MODIFY';

  private $container;

  public function __construct(Container $container)
  {
    $this->container = $container;
  }

  protected function getSupportedClasses()
  {
    return array('AppBundle\Entity\Comment');
  }

  protected function getSupportedAttributes()
  {
    return array(self::ATTRIBUTE_MODIFY);
  }

  protected function isGranted($attribute, $object, $user = null)
  {
    if(!is_object($user)){
      return false;
    }

    if($object->getUser() == $user->getUsername()){
      return true;
    }

    $authChecker = $this->container->get('security.authorization_checker');

    if($authChecker->isGranted('ROLE_ADMIN')){
      return true;
    }

    return false;
  }
}
