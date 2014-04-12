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
 *      @Date:   2014-04-12 09:17:11
 *      @Last Modified by:   Luis González Rodríguez
 *      @Last Modified time: 2014-04-12 09:17:11
 * 
 */
namespace Dentoleti\PatientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;
use Dentoleti\GeneralBundle\Meeting;
use Dentoleti\GeneralBundle\CivilStatus;
use Dentoleti\GeneralBundle\Town;

/**
 * Patient
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dentoleti\PatientBundle\Entity\PatientRepository")
 * @Assert\Callback(methods={"validDni", "numericPhones"})
 */
class Patient
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
     * @ORM\Column(name="nif", type="string", length=9, nullable=true)
     */
    private $nif;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname1", type="string", length=50, nullable=true)
     */
    private $surname1;

    /**
     * @var string
     *
     * @ORM\Column(name="surname2", type="string", length=50, nullable=true)
     */
    private $surname2;

    /**
     * @ORM\ManyToOne(targetEntity="Dentoleti\GeneralBundle\Entity\CivilStatus")
     * @ORM\JoinColumn(name="civilStatus_id", referencedColumnName="id", nullable=true)
     */
    private $civilStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="datetime", nullable=true)
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="phone1", type="string", length=15, nullable=true)
     */
    private $phone1;

    /**
     * @var string
     *
     * @ORM\Column(name="phone2", type="string", length=15, nullable=true)
     */
    private $phone2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=100, nullable=true)
     */
    private $address;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Dentoleti\PersonalBundle\Entity\Doctor",cascade={"persist"})
     * @ORM\JoinColumn(name="doctor_id", referencedColumnName="id", nullable=true, unique=false)
     */
    private $doctor;

    /**
     * @ORM\ManyToOne(targetEntity="Dentoleti\GeneralBundle\Entity\Town")
     * @ORM\JoinColumn(name="town_id", referencedColumnName="id", nullable=true)
     */
    private $town;

    /**
     * @ORM\ManyToOne(targetEntity="Dentoleti\GeneralBundle\Entity\PostalCode")
     * @ORM\JoinColumn(name="postalcode_id", referencedColumnName="id", nullable=true)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="occupation", type="text", nullable=true)
     */
    private $occupation;

    /**
     * @var string
     *
     * @ORM\Column(name="allergies", type="text", nullable=true)
     */
    private $allergies;

    /**
     * @var string
     *
     * @ORM\Column(name="diseases", type="text", nullable=true)
     */
    private $diseases;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vih", type="boolean")
     */
    private $vih;

    /**
     * @var boolean
     *
     * @ORM\Column(name="smoker", type="boolean")
     */
    private $smoker;

    /**
     * @var string
     *
     * @ORM\Column(name="observations", type="text", nullable=true)
     */
    private $observations;

    /**
     * @var string
     *
     * @ORM\Column(name="last_visit", type="string", length=50, nullable=true)
     */
    private $lastVisit;

    /**
     * @var string
     *
     * @ORM\Column(name="revision_frequency", type="string", length=30, nullable=true)
     */
    private $revisionFrequency;

    /**
     * @var string
     *
     * @ORM\Column(name="treatment", type="text", nullable=true)
     */
    private $treatment;

    /**
     * @ORM\ManyToOne(targetEntity="Dentoleti\GeneralBundle\Entity\Meeting")
     * @ORM\JoinColumn(name="meeting_id", referencedColumnName="id", nullable=true)
     */
    private $meeting;

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
     * Set nif
     *
     * @param string $nif
     * @return Patient
     */
    public function setNif($nif)
    {
        //upper the letter of the DNI
        $this->nif = strtoupper($nif);

        return $this;
    }

    /**
     * Get nif
     *
     * @return string 
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Patient
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
     * Set surname1
     *
     * @param string $surname1
     * @return Patient
     */
    public function setSurname1($surname1)
    {
        $this->surname1 = $surname1;

        return $this;
    }

    /**
     * Get surname1
     *
     * @return string 
     */
    public function getSurname1()
    {
        return $this->surname1;
    }

    /**
     * Set surname2
     *
     * @param string $surname2
     * @return Patient
     */
    public function setSurname2($surname2)
    {
        $this->surname2 = $surname2;

        return $this;
    }

    /**
     * Get surname2
     *
     * @return string 
     */
    public function getSurname2()
    {
        return $this->surname2;
    }

    /**
     * Set civilStatus
     *
     * @param integer $civilStatus
     * @return Patient
     */
    public function setCivilStatus($civilStatus)
    {
        $this->civilStatus = $civilStatus;

        return $this;
    }

    /**
     * Get civilStatus
     *
     * @return integer 
     */
    public function getCivilStatus()
    {
        return $this->civilStatus;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return Patient
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set phone1
     *
     * @param string $phone1
     * @return Patient
     */
    public function setPhone1($phone1)
    {
        $this->phone1 = $phone1;

        return $this;
    }

    /**
     * Get phone1
     *
     * @return string 
     */
    public function getPhone1()
    {
        return $this->phone1;
    }

    /**
     * Set phone2
     *
     * @param string $phone2
     * @return Patient
     */
    public function setPhone2($phone2)
    {
        $this->phone2 = $phone2;

        return $this;
    }

    /**
     * Get phone2
     *
     * @return string 
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * Set town
     *
     * @param integer $town
     * @return Patient
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return integer 
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set postalCode
     *
     * @param integer $postalCode
     * @return Patient
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return integer 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set occupation
     *
     * @param string $occupation
     * @return Patient
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;

        return $this;
    }

    /**
     * Get occupation
     *
     * @return string 
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Set allergies
     *
     * @param string $allergies
     * @return Patient
     */
    public function setAllergies($allergies)
    {
        $this->allergies = $allergies;

        return $this;
    }

    /**
     * Get allergies
     *
     * @return string 
     */
    public function getAllergies()
    {
        return $this->allergies;
    }

    /**
     * Set diseases
     *
     * @param string $diseases
     * @return Patient
     */
    public function setDiseases($diseases)
    {
        $this->diseases = $diseases;

        return $this;
    }

    /**
     * Get diseases
     *
     * @return string 
     */
    public function getDiseases()
    {
        return $this->diseases;
    }

    /**
     * Set vih
     *
     * @param integer $vih
     * @return Patient
     */
    public function setVih($vih)
    {
        $this->vih = $vih;

        return $this;
    }

    /**
     * Get vih
     *
     * @return integer 
     */
    public function getVih()
    {
        return $this->vih;
    }

    /**
     * Set observations
     *
     * @param string $observations
     * @return Patient
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
     * Set lastVisit
     *
     * @param string $lastVisit
     * @return Patient
     */
    public function setLastVisit($lastVisit)
    {
        $this->lastVisit = $lastVisit;

        return $this;
    }

    /**
     * Get lastVisit
     *
     * @return string 
     */
    public function getLastVisit()
    {
        return $this->lastVisit;
    }

    /**
     * Set revisionFrequency
     *
     * @param string $revisionFrequency
     * @return Patient
     */
    public function setRevisionFrequency($revisionFrequency)
    {
        $this->revisionFrequency = $revisionFrequency;

        return $this;
    }

    /**
     * Get revisionFrequency
     *
     * @return string 
     */
    public function getRevisionFrequency()
    {
        return $this->revisionFrequency;
    }

    /**
     * Set treatment
     *
     * @param string $treatment
     * @return Patient
     */
    public function setTreatment($treatment)
    {
        $this->treatment = $treatment;

        return $this;
    }

    /**
     * Get treatment
     *
     * @return string 
     */
    public function getTreatment()
    {
        return $this->treatment;
    }

    /**
     * Set meeting
     *
     * @param $meeting
     * @return Patient
     */
    public function setMeeting($meeting)
    {
        $this->meeting = $meeting;

        return $this;
    }

    /**
     * Get meeting
     *
     * @return integer 
     */
    public function getMeeting()
    {
        return $this->meeting;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Patient
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Patient
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    public function __toString()
    {
        return $this->getName() . ' ' . $this->getSurname1() . ' ' . $this->getSurname2();
    }

    /**
     * Validator method for checking if the phone telephones are not numeric
     */
    public function numericPhones(ExecutionContextInterface $context)
    {
        $validation = true;
        if (strlen($this->getPhone1() > 0) && !is_numeric($this->getPhone1())) {
            $context->addViolationAt('phone1', 'El teléfono 1 no es válido', array(), null);
            $validation = false;
        }
        if (strlen($this->getPhone2() > 0) && !is_numeric($this->getPhone2())) {
            $context->addViolationAt('phone2', 'El teléfono 2 no es válido', array(), null);
            $validation = false;
        }
        return $validation;
    }

    /**
     * Validator method for checking the DNI/CIF given
     */
    public function validDni(ExecutionContextInterface $context)
    {
        $dni = $this->getNif();

        if ((strlen($dni) > 0) && (!$this->validateNif($dni))) {
            if (!$this->validateCif($dni)) {
                $context->addViolationAt('nif', 'El nif/cif no es válido', array(), null);
                return false;
            }
            else {
                return true;
            }
        }
        else {
            return true;
        }
    }

    /**
     * CIF Validation
     */
    public function validateCif ($cif) {
        if (strlen($cif) != 9) {
            return false;
        }
        $cif_codes = 'JABCDEFGHI';

        $sum = (string) $this->getCifSum ($cif);
        $n = (10 - substr ($sum, -1)) % 10;

        if (preg_match ('/^[ABCDEFGHJNPQRSUVW]{1}/', $cif)) {
            if (in_array ($cif[0], array ('A', 'B', 'E', 'H'))) {
                // Numerico
                return ($cif[8] == $n);
            } elseif (in_array ($cif[0], array ('K', 'P', 'Q', 'S'))) {
                // Letras
                return ($cif[8] == $cif_codes[$n]);
            } else {
                // Alfanumérico
                if (is_numeric ($cif[8])) {
                    return ($cif[8] == $n);
                } else {
                    return ($cif[8] == $cif_codes[$n]);
                }
            }
        }
        return false;
    }

    /**
     * NIE, DNI and NIF validation
     */
    public function validateNif($nif) {
        if (strlen($nif) != 9){
            return false;
        }
        $nif_codes = 'TRWAGMYFPDXBNJZSQVHLCKE';

        $sum = (string) $this->getCifSum($nif);
        $n = 10 - substr($sum, -1);

        if (preg_match ('/^[0-9]{8}[A-Z]{1}$/', $nif)) {
            // DNIs
            $num = substr($nif, 0, 8);

            return ($nif[8] == $nif_codes[$num % 23]);
        } elseif (preg_match ('/^[XYZ][0-9]{7}[A-Z]{1}$/', $nif)) {
            // NIEs normales
            $tmp = substr ($nif, 1, 7);
            $tmp = strtr(substr ($nif, 0, 1), 'XYZ', '012') . $tmp;

            return ($nif[8] == $nif_codes[$tmp % 23]);
        } elseif (preg_match ('/^[KLM]{1}/', $nif)) {
            // NIFs especiales
            return ($nif[8] == chr($n + 64));
        } elseif (preg_match ('/^[T]{1}[A-Z0-9]{8}$/', $nif)) {
            // NIE extraño
            return true;
        }

        return false;
    }

    /** 
     * Auxiliar function for special CIF and NIFS
     *
     */
    private function getCifSum ($cif) {
        $sum = $cif[2] + $cif[4] + $cif[6];

        for ($i = 1; $i<8; $i += 2) {
            $tmp = (string) (2 * $cif[$i]);

            $tmp = $tmp[0] + ((strlen ($tmp) == 2) ?  $tmp[1] : 0);

            $sum += $tmp;
        }

        return $sum;
    }


    /**
     * Set smoker
     *
     * @param boolean $smoker
     *
     * @return Patient
     */
    public function setSmoker($smoker)
    {
        $this->smoker = $smoker;

        return $this;
    }

    /**
     * Get smoker
     *
     * @return boolean 
     */
    public function getSmoker()
    {
        return $this->smoker;
    }

    /**
     * Set doctor
     *
     * @param \Dentoleti\PersonalBundle\Entity\Doctor $doctor
     *
     * @return Patient
     */
    public function setDoctor(\Dentoleti\PersonalBundle\Entity\Doctor $doctor = null)
    {
        $this->doctor = $doctor;

        return $this;
    }

    /**
     * Get doctor
     *
     * @return \Dentoleti\PersonalBundle\Entity\Doctor 
     */
    public function getDoctor()
    {
        return $this->doctor;
    }
}
