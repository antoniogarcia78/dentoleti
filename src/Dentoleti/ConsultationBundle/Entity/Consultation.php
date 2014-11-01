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
 *      @Date:   2014-04-12 10:27:46
 *      @Last Modified by:   Luis González Rodríguez
 *      @Last Modified time: 2014-04-12 10:27:46
 * 
 */
namespace Dentoleti\ConsultationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Consultation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dentoleti\ConsultationBundle\Entity\ConsultationRepository")
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
     * @ORM\Column(name="treatmentSheet", type="text", nullable=true)
     */
    private $treatmentSheet;

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
     * @ORM\ManyToOne(targetEntity="Dentoleti\ConsultationBundle\Entity\ConsultationState")
     * @ORM\JoinColumn(name="consultation_state_id", referencedColumnName="id", nullable=true)
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

    /**
     * Set state
     *
     * @param \Dentoleti\ConsultationBundle\Entity\ConsultationState $state
     *
     * @return Consultation
     */
    public function setState(\Dentoleti\ConsultationBundle\Entity\ConsultationState $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \Dentoleti\ConsultationBundle\Entity\ConsultationState 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set treatmentSheet
     *
     * @param string $treatmentSheet
     *
     * @return Consultation
     */
    public function setTreatmentSheet($treatmentSheet)
    {
        $this->treatmentSheet = $treatmentSheet;

        return $this;
    }

    /**
     * Get treatmentSheet
     *
     * @return string 
     */
    public function getTreatmentSheet()
    {
        return $this->treatmentSheet;
    }
}
