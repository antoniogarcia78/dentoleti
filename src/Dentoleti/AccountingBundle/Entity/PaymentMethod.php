<?php

namespace Dentoleti\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentMethod
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PaymentMethod
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
     * @ORM\Column(name="methodName", type="string", length=20)
     */
    private $methodName;


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
     * Set methodName
     *
     * @param string $methodName
     *
     * @return PaymentMethod
     */
    public function setMethodName($methodName)
    {
        $this->methodName = $methodName;

        return $this;
    }

    /**
     * Get methodName
     *
     * @return string 
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * Method toString
     */
    public function __toString()
    {
        return $this->getMethodName();
    }
}
