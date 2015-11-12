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
        'label'              => 'contact.name',
        'translation_domain' => 'messages'
      ))
      ->add('lastname', 'text', array(
        'required'           => false,
        'label'              => 'contact.last_name',
        'translation_domain' => 'messages'
      ))
      ->add('address', 'text', array(
        'required'           => false,
        'label'              => 'contact.address',
        'translation_domain' => 'messages'
      ))
      ->add('city', 'text', array(
        'required'           => false,
        'label'              => 'contact.city',
        'translation_domain' => 'messages'
      ))
      ->add('phone', 'text', array(
        'required'           => false,
        'label'              => 'contact.phone',
        'translation_domain' => 'messages'
      ))
      ->add('mobilephone', 'text', array(
        'required'           => false,
        'label'              => 'contact.mobile_phone',
        'translation_domain' => 'messages'
      ))
      ->add('email', 'email', array(
        'required'           => false,
        'label'              => 'contact.email',
        'translation_domain' => 'messages'
      ))
      ->add('company', 'text', array(
        'required'           => false,
        'label'              => 'contact.company',
        'translation_domain' => 'messages'
      ))
      ->add('annotations', 'textarea', array(
        'required'           => false,
        'label'              => 'contact.annotations',
        'translation_domain' => 'messages'
      ));
  }

  public function setDefaultsOptions(OptionResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'AppBundle\Entity\Contact'
    ));
  }

  public function getName()
  {
    return 'app_ContactProfile';
  }
}
