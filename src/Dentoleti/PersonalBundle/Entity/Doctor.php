<?php

namespace Dentoleti\PersonalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Dentoleti\PersonalBundle\Entity\Personal;

/**
 * Doctor
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * @OneToOne(targetEntity="Personal")
     * @JoinColumn(name="personal_id", referencedColumnName="id")
     * @Assert\Type(type="Dentoleti\PersonalBundle\Entity\Personal")
     */
    private $personal;

    /**
     * @var string
     *
     * @ORM\Column(name="speciality", type="string", length=255)
     */
    private $speciality;

    /**
     * @var string
     *
     * @ORM\Column(name="referee", type="string", length=12)
     */
    private $referee;

    /**
     * @var string
     *
     * @ORM\Column(name="observations", type="text")
     */
    private $observations;

    /**
     * @var float
     *
     * @ORM\Column(name="commission", type="float")
     */
    private $commission;


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
     * Set observations
     *
     * @param string $observations
     * @return Doctor
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations
     *
     * @return string 
     */
    public function getObservations()
    {
        return $this->observations;
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
}
