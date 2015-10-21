<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('roles', 'choice', array(
        'label' => 'Rol',
        'required' => true,
        'choices' => array(
          'ROLE_USER'        => 'USUARIO' ,
          'ROLE_ADMIN'       => 'ADMINISTRADOR',
          'ROLE_SUPER_ADMIN' => 'SUPERADMINISTRADOR'),
          'multiple'         => true
        ));
  }

  public function getParent()
  {
    return 'fos_user_registration';
  }

  public function getName()
  {
    return 'app_user_registration';
  }
}
