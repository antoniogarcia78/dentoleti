<?php

namespace Dentoleti\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostalCode
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PostalCode
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
     * @ORM\Column(name="postalCode", type="string", length=5)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="Dentoleti\GeneralBundle\Entity\Town", inversedBy="postalcodes")
     */
    private $towns;

    /**
     * Set Id
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set postalCode
     *
     * @param string $postalCode
     * @return PostalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Método toString
     */
    public function __toString()
    {
        return $this->getPostalCode();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->towns = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add towns
     *
     * @param \Dentoleti\GeneralBundle\Entity\Town $towns
     *
     * @return PostalCode
     */
    public function addTown(\Dentoleti\GeneralBundle\Entity\Town $towns)
    {
        $this->towns[] = $towns;

        return $this;
    }

    /**
     * Remove towns
     *
     * @param \Dentoleti\GeneralBundle\Entity\Town $towns
     */
    public function removeTown(\Dentoleti\GeneralBundle\Entity\Town $towns)
    {
        $this->towns->removeElement($towns);
    }

    /**
     * Get towns
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTowns()
    {
        return $this->towns;
    }
}
