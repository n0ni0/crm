<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Contact;

class Contacts extends AbstractFixture implements OrderedFixtureInterface
{
  public function getOrder(){
    return 60;
  }

  public function load(ObjectManager $manager)
  {
    $testContact = new Contact();
    $testContact->setName('User');
    $testContact->setLastName('Test');
    $testContact->setAddress('calle test');
    $testContact->setCity('Villatest');
    $testContact->setPhone(956666666);
    $testContact->setMobilePhone(666666666);
    $testContact->setEmail('test@crm.local');
    $testContact->setCompany('testCompany');
    $testContact->setAnnotations('Test annotation');

    $manager->persist($testContact);

    for ($i = 1; $i < 30; $i++) {
      $contact = new Contact();
      $mobile = rand(661000000,669999999);
      $phone  = rand(910000000,999999999);

      $contact->setName($this->getName());
      $contact->setLastName($this->getLastName());
      $contact->setAddress('calle'.$i);
      $contact->setCity($this->getCity());
      $contact->setPhone($phone);
      $contact->setMobilePhone($mobile);
      $contact->setEmail('contact'.$i.'@localhost');
      $contact->setCompany('company'.$i);
      $contact->setAnnotations($this->getAnnotations());

      $manager->persist($contact);
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

  private function getAnnotations()
  {
    $annotations = array(
      'Este usuario tiene una anotación.'
     );
       return $annotations[array_rand($annotations)];
  }

}
