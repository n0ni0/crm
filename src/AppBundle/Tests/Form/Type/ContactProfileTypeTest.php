<?php

namespace AppBundle\Tests\Form\Type;

use AppBundle\Form\Type\ContactProfileType;
use Symfony\Component\Form\Test\TypeTestCase;

class ContactProfileTypeTest extends TypeTestCase
{
    public function testSubmitContactProfileTypeForm()
    {
        $formData = array(
            'name'        => 'user',
            'lastname'    => 'test',
            'address'     => 'Villatest',
            'city'        => 'TestTown',
            'phone'       =>  956490009,
            'mobilephone' =>  660000090,
            'email'       => 'user@test.test',
            'company'     => 'Test company',
            'annotations'  => 'Test annotation'
        );

        $type = new ContactProfileType();
        $form = $this->factory->create($type);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}