<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\DataTransformer\DateTimeTransformer;

class PlanningType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('user', 'entity', array(
        'class'        => 'AppBundle:User',
        'choice_label' =>'username',
      ))

      ->add('start', 'text', array(
        'attr'           => array(
          'class'        => 'form-control input-inline datetimepicker6',
          'data-provide' => 'datepicker',
          'data-format'  => 'dd-mm-yyyy HH:ii',
        )
      ))

      ->add('end', 'text', array(
        'attr'           => array(
          'class'        => 'form-control input-inline datetimepicker7',
          'data-provide' => 'datepicker',
          'data-format'  => 'dd-mm-yyyy HH:ii',
        )
      ));

    $builder
      ->get('start')
      ->addModelTransformer(new DateTimeTransformer());

    $builder
      ->get('end')
      ->addModelTransformer(new DateTimeTransformer());
  }

  public function configureOptions(OptionsResolver $resolver)
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
