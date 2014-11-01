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
 *      @Date:   2014-04-12 09:21:33
 *      @Last Modified by:   Luis González Rodríguez
 *      @Last Modified time: 2014-04-12 09:21:33
 * 
 */
namespace Dentoleti\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Day
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Day
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
     * @ORM\Column(name="name", type="string", length=9)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Dentoleti\PersonalBundle\Entity\Doctor", mappedBy="days")
     */
    private $doctors;

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
     *
     * @return Day
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
     * Constructor
     */
    public function __construct()
    {
        $this->doctors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add doctors
     *
     * @param \Dentoleti\PersonalBundle\Entity\Doctor $doctors
     *
     * @return Day
     */
    public function addDoctor(\Dentoleti\PersonalBundle\Entity\Doctor $doctors)
    {
        $this->doctors[] = $doctors;

        return $this;
    }

    /**
     * Remove doctors
     *
     * @param \Dentoleti\PersonalBundle\Entity\Doctor $doctors
     */
    public function removeDoctor(\Dentoleti\PersonalBundle\Entity\Doctor $doctors)
    {
        $this->doctors->removeElement($doctors);
    }

    /**
     * Get doctors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDoctors()
    {
        return $this->doctors;
    }

    /**
     * Method toString
     */
    public function __toString()
    {
        return $this->getName();
    }
}
