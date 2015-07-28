<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * customerCategory
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CustomerCategory
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
     * @ORM\Column(name="customerCategory", type="string", length=255)
     */
    private $customerCategory;


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
     * Set customerCategory
     *
     * @param string $customerCategory
     * @return customerCategory
     */
    public function setCustomerCategory($customerCategory)
    {
        $this->customerCategory = $customerCategory;

        return $this;
    }

    /**
     * Get customerCategory
     *
     * @return string 
     */
    public function getCustomerCategory()
    {
        return $this->customerCategory;
    }
}
