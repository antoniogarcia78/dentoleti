<?php

namespace Dentoleti\ConsultationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Consultation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Consultation
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
     *
     * @ORM\ManyToOne(targetEntity="Dentoleti\PatientBundle\Entity\Patient")
     * @ORM\JoinColumn(name="patient_id", referencedColumnName="id", nullable=true)
     */
    private $patient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime")
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Dentoleti\PersonalBundle\Entity\Doctor")
     * @ORM\JoinColumn(name="patient_id", referencedColumnName="id", nullable=true)
     */
    private $doctor;

    /**
     * @var string
     *
     * @ORM\Column(name="motivation", type="text")
     */
    private $motivation;

    /**
     * @var string
     *
     * @ORM\Column(name="observations", type="text", nullable=true)
     */
    private $observations;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="concertationDate", type="datetime", nullable=true)
     */
    private $concertationDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="assists", type="boolean")
     */
    private $assists;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=true)
     */
    private $state;


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
     * Set patient
     *
     * @param string $patient
     * @return Consultation
     */
    public function setPatient($patient)
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * Get patient
     *
     * @return string 
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Consultation
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Consultation
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Consultation
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set doctor
     *
     * @param string $doctor
     * @return Consultation
     */
    public function setDoctor($doctor)
    {
        $this->doctor = $doctor;

        return $this;
    }

    /**
     * Get doctor
     *
     * @return string 
     */
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * Set motivation
     *
     * @param string $motivation
     * @return Consultation
     */
    public function setMotivation($motivation)
    {
        $this->motivation = $motivation;

        return $this;
    }

    /**
     * Get motivation
     *
     * @return string 
     */
    public function getMotivation()
    {
        return $this->motivation;
    }

    /**
     * Set observations
     *
     * @param string $observations
     * @return Consultation
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
     * Set price
     *
     * @param float $price
     * @return Consultation
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set assists
     *
     * @param boolean $assists
     * @return Consultation
     */
    public function setAssists($assists)
    {
        $this->assists = $assists;

        return $this;
    }

    /**
     * Get assists
     *
     * @return boolean 
     */
    public function getAssists()
    {
        return $this->assists;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Consultation
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set concertationDate
     *
     * @param \DateTime $concertationDate
     *
     * @return Consultation
     */
    public function setConcertationDate($concertationDate)
    {
        $this->concertationDate = $concertationDate;

        return $this;
    }

    /**
     * Get concertationDate
     *
     * @return \DateTime 
     */
    public function getConcertationDate()
    {
        return $this->concertationDate;
    }
}
