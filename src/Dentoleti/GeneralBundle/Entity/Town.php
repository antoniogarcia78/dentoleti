<?php

namespace Dentoleti\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Town
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dentoleti\GeneralBundle\Entity\TownRepository")
 */
class Town
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Province")
     * @ORM\JoinColumn(name="province_id", referencedColumnName="id")
     */
    private $province;

    /**
     * @ORM\ManyToMany(targetEntity="Dentoleti\GeneralBundle\Entity\PostalCode", mappedBy="towns")
     */
    private $postalcodes;

    public function __construct()
    {
        $this->postalcodes = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Town
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set province
     *
     * @param string $province
     * @return Town
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string 
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Método toString
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Add postalcodes
     *
     * @param \Dentoleti\GeneralBundle\Entity\PostalCode $postalcodes
     *
     * @return Town
     */
    public function addPostalcode(\Dentoleti\GeneralBundle\Entity\PostalCode $postalcodes)
    {
        $this->postalcodes[] = $postalcodes;

        return $this;
    }

    /**
     * Remove postalcodes
     *
     * @param \Dentoleti\GeneralBundle\Entity\PostalCode $postalcodes
     */
    public function removePostalcode(\Dentoleti\GeneralBundle\Entity\PostalCode $postalcodes)
    {
        $this->postalcodes->removeElement($postalcodes);
    }

    /**
     * Get postalcodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostalcodes()
    {
        return $this->postalcodes;
    }
}
