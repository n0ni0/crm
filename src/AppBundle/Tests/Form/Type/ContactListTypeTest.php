<?php

namespace AppBundle\Tests\Form\Type;

use AppBundle\Form\Type\CommentType;
use Symfony\Component\Form\Test\TypeTestCase;

class ContactListTypeTest extends TypeTestCase
{
    public function testSubmitContactListTypeForm()
    {
        $formData = array(
            'content' => 'test comment form',
        );

        $type = new CommentType();
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