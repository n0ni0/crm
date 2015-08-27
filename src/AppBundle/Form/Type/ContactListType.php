<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\True;

class ContactListType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('contact', 'choice', array(
        'choices'       => array(
          'name'        => 'Nombre',
          'lastname'    => 'Apellidos',
          'email'       => 'Email',
          'company'     => 'Empresa',
        ),
        'label'         => false,
        'placeholder'   => 'Ordenado por:',
      ));
  }

  public function getName()
  {
    return 'app_ContactList';
  }
}
