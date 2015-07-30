<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\CustomerCategory;
use AppBundle\Entity\Customer;

class Customers extends AbstractFixture implements OrderedFixtureInterface
{
  public function getOrder(){
    return 60;
  }

  public function load(ObjectManager $manager)
  {
    $customerCategories = $manager->getRepository('AppBundle:CustomerCategory')->findAll();

    for ($i = 0; $i < 30; $i++) {
      $customer = new Customer();
      $customerCategory = $customerCategories[array_rand($customerCategories)];
      $mobile = rand(661000000,669999999);
      $phone  = rand(910000000,999999999);

      $customer->setName($this->getName());
      $customer->setLastName($this->getLastName());
      $customer->setAddress('calle'.$i);
      $customer->setCity($this->getCity());
      $customer->setCountry($this->getCountry());
      $customer->setPhone($phone);
      $customer->setMobilePhone($mobile);
      $customer->setEmail('customer'.$i.'@localhost');
      $customer->setCompany('company'.$i);
      $customer->setAnnotations($this->getAnnotations());
      $customer->setPhoto('photo'.$i.'.jpg');
      $customer->setCustomerCategory($customerCategory);

      $manager->persist($customer);
    }
    $manager->flush();
  }

  private function getName()
  {
    $mens = array(
       'Antonio', 'José', 'Manuel', 'Francisco', 'Juan', 'David',
       'José Antonio', 'José Luis', 'Jesús', 'Javier', 'Francisco Javier',
       'Carlos', 'Daniel', 'Miguel', 'Rafael', 'Pedro', 'José Manuel',
       'Ángel', 'Alejandro', 'Miguel Ángel', 'José María', 'Fernando',
       'Luis', 'Sergio', 'Pablo', 'Jorge', 'Alberto'
     );
    $womens = array(
       'María Carmen', 'María', 'Carmen', 'Josefa', 'Isabel', 'Ana María',
       'María Dolores', 'María Pilar', 'María Teresa', 'Ana', 'Francisca',
       'Laura', 'Antonia', 'Dolores', 'María Angeles', 'Cristina', 'Marta',
       'María José', 'María Isabel', 'Pilar', 'María Luisa', 'Concepción',
       'Lucía', 'Mercedes', 'Manuela', 'Elena', 'Rosa María'
     );

     if (rand() % 2) {
       return $mens[array_rand($mens)];
     } else {
       return $womens[array_rand($womens)];
     }
  }

  private function getLastName()
  {
    $names = array(
        'Martinez','Rodríguez','Gómez','Fernández','López','Díaz',
        'Rodriguez','Pérez','García','Sánchez','Romero','Sosa',
        'Álvarez','Torres','Ruiz','Ramírez','Flores','Acosta',
        'Benítez','Medina','Suárez','Herrera','Aguirre','Pereyra',
        'Gutiérrez','Jiménez','Molina','Silva','Castro','Rojas'
     );
       return $names[array_rand($names)];
  }

  private function getCity()
  {
    $city = array(
        'Albacete','Alcobendas','Alcorcón','Alcoi','Algeciras','Alicante',
        'Almería','Ávila','Avilés','Badajoz','Badalona','Barcelona','Benidorm',
        'Bilbao','Burgos','Cáceres','Cádiz','Cartagena','Castellón de ña Plana',
        'Cerdanyola del Vallés','Ceuta','Chiclana de la Frontera','Ciudad Real',
        'Collado Villalba','Córdoba','Donostia-San Sebastian'
     );
       return $city[array_rand($city)];
  }

  private function getCountry()
  {
    $country = array(
        'España','Inglaterra','Francia','Alemania'
     );
       return $country[array_rand($country)];
  }

  private function getAnnotations()
  {
    $annotations = array(
        'Vivamus congue lacus nunc. Nulla facilisi. Morbi vitae turpis et mi 
        accumsan tristique. Donec posuere lacus risus, eget tincidunt mi malesuada at.
        Sed finibus elit hendrerit felis facilisis placerat. Morbi tincidunt sapien 
        in lorem sagittis mollis. Fusce ultricies auctor neque id dictum. 
        Maecenas eu fermentum dui. Pellentesque et pulvinar magna. Nulla ac mi at 
        tellus laoreet ullamcorper nec vitae lorem. Curabitur id fringilla ante. 
        Nulla tempor nisl sed ipsum facilisis, maximus malesuada risus pellentesque. 
        Nunc lacus felis, bibendum suscipit ornare eu, congue accumsan erat. 
        Donec tincidunt rhoncus convallis. Proin aliquet felis nec purus tristique, 
        eu vulputate nulla mollis. Nulla venenatis nunc tellus, 
        mollis sodales enim posuere ac.'
     );
       return $annotations[array_rand($annotations)];
  }

}
