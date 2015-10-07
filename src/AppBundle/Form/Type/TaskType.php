<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('title', 'text', array(
        'label'              => 'task.title',
      ))
      ->add('taskCategory', 'entity', array(
        'label'              => 'task.category',
        'class'              => 'AppBundle:TaskCategory',
        'property'           => 'taskCategory',
        'empty_value'        => 'Selecciona una opción',
        'translation_domain' => 'messages'
      ))
      ->add('state', 'entity', array(
        'label'              => 'task.state',
        'class'              => 'AppBundle:State',
        'property'           => 'state',
        'empty_value'        => 'Selecciona una opción',
        'translation_domain' => 'messages'
      ))
      ->add('description', 'textarea', array(
        'label'              => 'task.description',
        'translation_domain' => 'messages',
      ));
  }

  public function setDefaultsOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class'         => 'AppBundle\Entity\Task',
    ));
  }

  public function getName()
  {
    return 'app_task';
  }
}
