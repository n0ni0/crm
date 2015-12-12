<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanningType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('user', 'entity', array(
        'class' => 'AppBundle:User',
        'choice_label' =>'username',
      ))

      ->add('start', 'datetime')

      ->add('end', 'datetime');
  }

  public function setDefaultsOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'AppBundle\Entity\Calendar'
    ));
  }

  public function getName()
  {
    return 'app_planning';
  }
}