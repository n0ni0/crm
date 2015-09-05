<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NoteType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('title', 'text', array(
        'label'               => 'note.title',
        'translation_domain'  => 'messages'
      ))
      ->add('private', 'choice', array(
        'choices'   => array(
          '0'       => 'note.public',
          '1'        =>'note.private',
        ),
        'label'              => 'note.visibility',
        'translation_domain' => 'messages'
      ))
      ->add('content', 'textarea', array(
        'label'               => 'note.content',
        'translation_domain'  => 'messages'
      ));
  }

  public function setDefaultsOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'AppBundle\Entity\Notes'
    ));
  }

  public function getName()
  {
    return 'app_note';
  }
}
