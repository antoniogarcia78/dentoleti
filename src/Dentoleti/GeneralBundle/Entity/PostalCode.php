<?php
/*
 *  This file is part of Dentoleti.
 *
 *  Dentoleti is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Dentoleti is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Dentoleti. Read COPYING.txt file for more information.
 *  If it is not present, see <http://www.gnu.org/licenses/>. 
 *
 *  You should find all the information about Dentoleti in http://dentoleti.es
 *
 *  Author Information:
 *      @Author: Luis González Rodríguez
 *      @Email: desarrollo@luismagonzalez.es
 *      @Github: https://github.com/luismagr
 *      @Author web: http://luismagonzalez.es
 *
 *  File Information:
 *      @Date:   2014-04-12 09:21:39
 *      @Last Modified by:   Luis González Rodríguez
 *      @Last Modified time: 2014-04-12 09:21:39
 * 
 */
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
