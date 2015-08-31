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
        'choices'            => array(
          'name'             => 'contact.name',
          'lastname'         => 'contact.last_name',
          'email'            => 'contact.email',
          'company'          => 'contact.company',
        ),
        'label'              => false,
        'translation_domain' => 'messages',
        'placeholder'        => 'contact.ordered_by',
      ));
  }

  public function getName()
  {
    return 'app_ContactList';
  }
}
