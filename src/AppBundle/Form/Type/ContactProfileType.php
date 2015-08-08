<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\True;

class ContactProfileType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', 'text', array(
        'label' => 'Nombre:'
      ))
      ->add('lastname', 'text', array(
        'label' => 'Apellidos:',
      ))
      ->add('address', 'text', array(
        'label' => 'Dirección:',
      ))
      ->add('city', 'text', array(
        'label' => 'Ciudad:',
      ))
      ->add('phone', 'text', array(
        'label' => 'Teléfono:',
      ))
      ->add('mobilephone', 'text', array(
        'label' => 'Móvil:',
      ))
      ->add('email', 'email', array(
        'label' => 'Email:',
      ))
      ->add('company', 'text', array(
        'label' => 'Empresa:',
      ))
      ->add('annotations', 'textarea', array(
        'label' => 'Anotaciones:',
      ))
      ->add('Actualizar', 'submit', array(
      ));
  }

  public function setDefaultsOptions(OptionResolverInterface $resolver)
  {
    $resolver->setDefatults(array(
      'data_class' => 'AppBundle\Entity\Contact'
    ));
  }

  public function getName()
  {
    return 'editContact';
  }
}
