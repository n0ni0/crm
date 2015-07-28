<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaskCategory
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TaskCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="task_category", type="string", length=255)
     */
    private $taskCategory;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set taskCategory
     *
     * @param string $taskCategory
     * @return TaskCategory
     */
    public function setTaskCategory($taskCategory)
    {
        $this->taskCategory = $taskCategory;

        return $this;
    }

    /**
     * Get taskCategory
     *
     * @return string 
     */
    public function getTaskCategory()
    {
        return $this->taskCategory;
    }
}
