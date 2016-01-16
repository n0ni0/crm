<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DateTimeTransformer implements DatatransformerInterface
{
  public function transform($datetime)
  {
    if(null === $datetime){
      return '';
    }

    return $datetime->format('d/m/Y H:i');
  }

  public function reverseTransform($datetime)
  {
    if(!$datetime){
      return;
    }

    return date_create_from_format('d/m/Y H:i', $datetime, new \DateTimeZone('Europe/Madrid'));
  }
}
