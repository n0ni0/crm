<?php

namespace AppBundle\Tests\Form\Type;

use AppBundle\Form\Type\NoteType;
use Symfony\Component\Form\Test\TypeTestCase;

class NoteTypeTest extends TypeTestCase
{
    public function testNoteTypeForm()
    {
        $formData = array(
            'title'   => 'test title',
            'private' => 0,
            'content' => 'Test note content'
        );

        $type = new NoteType();
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