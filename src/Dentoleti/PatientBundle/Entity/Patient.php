<?php

namespace Dentoleti\PatientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Dentoleti\GeneralBundle\Meeting;

/**
 * Patient
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * @ORM\Column(name="nif", type="string", length=9)
     */
    private $nif;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname1", type="string", length=50)
     */
    private $surname1;

    /**
     * @var string
     *
     * @ORM\Column(name="surname2", type="string", length=50)
     */
    private $surname2;

    /**
     * @var integer
     *
     * @ORM\Column(name="civil_status", type="smallint")
     */
    private $civilStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="datetime")
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="phone1", type="string", length=15)
     */
    private $phone1;

    /**
     * @var string
     *
     * @ORM\Column(name="phone2", type="string", length=15)
     */
    private $phone2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50)
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=100)
     */
    private $address;
    

    /**
     * @var integer
     *
     * @ORM\Column(name="country", type="integer")
     */
    private $country;

    /**
     * @var integer
     *
     * @ORM\Column(name="province", type="integer")
     */
    private $province;

    /**
     * @var integer
     *
     * @ORM\Column(name="town", type="integer")
     */
    private $town;

    /**
     * @var integer
     *
     * @ORM\Column(name="postal_code", type="integer")
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="occupation", type="text")
     */
    private $occupation;

    /**
     * @var string
     *
     * @ORM\Column(name="allergies", type="text")
     */
    private $allergies;

    /**
     * @var string
     *
     * @ORM\Column(name="diseases", type="text")
     */
    private $diseases;

    /**
     * @var integer
     *
     * @ORM\Column(name="vih", type="smallint")
     */
    private $vih;

    /**
     * @var string
     *
     * @ORM\Column(name="observations", type="text")
     */
    private $observations;

    /**
     * @var string
     *
     * @ORM\Column(name="last_visit", type="string", length=50)
     */
    private $lastVisit;

    /**
     * @var string
     *
     * @ORM\Column(name="revision_frequency", type="string", length=30)
     */
    private $revisionFrequency;

    /**
     * @var string
     *
     * @ORM\Column(name="treatment", type="text")
     */
    private $treatment;

    /**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="Dentoleti\GeneralBundle\Entity\Meeting", mappedBy="theway")
     */
    private $meeting;

    public function __construct() {
        $this->meetings = new ArrayCollection();
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
     * Set nif
     *
     * @param string $nif
     * @return Patient
     */
    public function setNif($nif)
    {
        $this->nif = $nif;

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
     * Set country
     *
     * @param integer $country
     * @return Patient
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return integer 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set province
     *
     * @param integer $province
     * @return Patient
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return integer 
     */
    public function getProvince()
    {
        return $this->province;
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
     * Set meetings
     *
     * @param integer $meetings
     * @return Patient
     */
    public function setMeetings($meetings)
    {
        $this->meetings = $meetings;

        return $this;
    }

    /**
     * Get meetings
     *
     * @return integer 
     */
    public function getMeetings()
    {
        return $this->meetings;
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

    /**
     * Add meetings
     *
     * @param \connect2tic\PatientBundle\Entity\Meeting $meetings
     * @return Patient
     */
    public function addMeeting(\connect2tic\PatientBundle\Entity\Meeting $meetings)
    {
        $this->meetings[] = $meetings;

        return $this;
    }

    /**
     * Remove meetings
     *
     * @param \connect2tic\PatientBundle\Entity\Meeting $meetings
     */
    public function removeMeeting(\connect2tic\PatientBundle\Entity\Meeting $meetings)
    {
        $this->meetings->removeElement($meetings);
    }
}
