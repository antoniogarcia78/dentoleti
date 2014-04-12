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
 *      @Date:   2014-04-12 09:23:23
 *      @Last Modified by:   Luis González Rodríguez
 *      @Last Modified time: 2014-04-12 09:23:23
 * 
 */
namespace Dentoleti\PersonalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Dentoleti\PersonalBundle\Entity\Personal;

/**
 * Doctor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dentoleti\PersonalBundle\Entity\DoctorRepository")
 */
class Doctor
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
     * @ORM\OneToOne(targetEntity="Personal", cascade={"persist"})
     * @ORM\JoinColumn(name="personal_id", referencedColumnName="id", nullable=true)
     * @Assert\Type(type="Dentoleti\PersonalBundle\Entity\Personal")
     */
    private $personal;

    /**
     * @ORM\ManyToOne(targetEntity="Dentoleti\PersonalBundle\Entity\Speciality")
     * @ORM\JoinColumn(name="speciality_id", referencedColumnName="id", nullable=true)
     */
    private $speciality;

    /**
     * @var string
     *
     * @ORM\Column(name="referee", type="string", length=12, nullable=true)
     */
    private $referee;

    /**
     * @var float
     *
     * @ORM\Column(name="commission", type="float", nullable=true)
     */
    private $commission;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="Dentoleti\GeneralBundle\Entity\Day", inversedBy="doctors")
     */
    private $days;


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
     * Set personal
     *
     * @param string $personal
     * @return Doctor
     */
    public function setPersonal($personal)
    {
        $this->personal = $personal;

        return $this;
    }

    /**
     * Get personal
     *
     * @return string 
     */
    public function getPersonal()
    {
        return $this->personal;
    }

    /**
     * Set speciality
     *
     * @param string $speciality
     * @return Doctor
     */
    public function setSpeciality($speciality)
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * Get speciality
     *
     * @return string 
     */
    public function getSpeciality()
    {
        return $this->speciality;
    }

    /**
     * Set referee
     *
     * @param string $referee
     * @return Doctor
     */
    public function setReferee($referee)
    {
        $this->referee = $referee;

        return $this;
    }

    /**
     * Get referee
     *
     * @return string 
     */
    public function getReferee()
    {
        return $this->referee;
    }

    /**
     * Set commission
     *
     * @param float $commission
     * @return Doctor
     */
    public function setCommission($commission)
    {
        $this->commission = $commission;

        return $this;
    }

    /**
     * Get commission
     *
     * @return float 
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * Method __toString
     */
    public function __toString()
    {
        return $this->getPersonal()->getName();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->days = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add days
     *
     * @param \Dentoleti\GeneralBundle\Entity\Day $days
     *
     * @return Doctor
     */
    public function addDay(\Dentoleti\GeneralBundle\Entity\Day $days)
    {
        $this->days[] = $days;

        return $this;
    }

    /**
     * Remove days
     *
     * @param \Dentoleti\GeneralBundle\Entity\Day $days
     */
    public function removeDay(\Dentoleti\GeneralBundle\Entity\Day $days)
    {
        $this->days->removeElement($days);
    }

    /**
     * Get days
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDays()
    {
        return $this->days;
    }
}
