<?php

namespace Dentoleti\BudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Budget
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Budget
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
     * @ORM\Column(name="budgetDate", type="datetime")
     */
    private $budgetDate;

    /**
     *
     * @ORM\OneToOne(targetEntity="Dentoleti\PersonalBundle\Entity\Doctor")
     * @ORM\JoinColumn(name="doctor_id", referencedColumnName="id", nullable=true)
     */
    private $doctor;

    /**
     * @var float
     *
     * @ORM\Column(name="discount", type="float")
     */
    private $discount;

     /**
     * @var string
     *
     * @ORM\Column(name="noTooth", type="text")
     */
    private $noTooth;

    /**
     * @var string
     *
     * @ORM\Column(name="observations", type="text")
     */
    private $observations;

    /**
     * @var float
     *
     * @ORM\Column(name="discountCompany", type="float")
     */
    private $discountCompany;

    /**
     * @var float
     *
     * @ORM\Column(name="discountInsurance", type="float")
     */
    private $discountInsurance;

    /**
     *
     * @ORM\OneToOne(targetEntity="Dentoleti\ConsultationBundle\Entity\Consultation")
     * @ORM\JoinColumn(name="consultation_id", referencedColumnName="id", nullable=true)
     */
    private $consultation;

    /**
     * @ORM\OneToMany(targetEntity="BudgetDetail", mappedBy="budget")
     */
    private $budgetDetails;

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
     * @return Budget
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
     * Set budgetDate
     *
     * @param \DateTime $budgetDate
     * @return Budget
     */
    public function setBudgetDate($budgetDate)
    {
        $this->budgetDate = $budgetDate;

        return $this;
    }

    /**
     * Get budgetDate
     *
     * @return \DateTime 
     */
    public function getBudgetDate()
    {
        return $this->budgetDate;
    }

    /**
     * Set doctor
     *
     * @param string $doctor
     * @return Budget
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
     * Set discount
     *
     * @param float $discount
     * @return Budget
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return float 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set noTooth
     *
     * @param string $noTooth
     * @return Budget
     */
    public function setNoTooth($noTooth)
    {
        $this->noTooth = $noTooth;

        return $this;
    }

    /**
     * Get noTooth
     *
     * @return string 
     */
    public function getNoTooth()
    {
        return $this->noTooth;
    }

    /**
     * Set observations
     *
     * @param string $observations
     * @return Budget
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
     * Set discountCompany
     *
     * @param float $discountCompany
     * @return Budget
     */
    public function setDiscountCompany($discountCompany)
    {
        $this->discountCompany = $discountCompany;

        return $this;
    }

    /**
     * Get discountCompany
     *
     * @return float 
     */
    public function getDiscountCompany()
    {
        return $this->discountCompany;
    }

    /**
     * Set discountInsurance
     *
     * @param float $discountInsurance
     * @return Budget
     */
    public function setDiscountInsurance($discountInsurance)
    {
        $this->discountInsurance = $discountInsurance;

        return $this;
    }

    /**
     * Get discountInsurance
     *
     * @return float 
     */
    public function getDiscountInsurance()
    {
        return $this->discountInsurance;
    }

    /**
     * Set consultation
     *
     * @param string $consultation
     * @return Budget
     */
    public function setConsultation($consultation)
    {
        $this->consultation = $consultation;

        return $this;
    }

    /**
     * Get consultation
     *
     * @return string 
     */
    public function getConsultation()
    {
        return $this->consultation;
    }

    /**
     * Method toString
     */
    public function __toString()
    {
        return $this->getId();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->budgetDetails = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add budgetDetails
     *
     * @param \Dentoleti\BudgetBundle\Entity\BudgetDetail $budgetDetails
     * @return Budget
     */
    public function addBudgetDetail(\Dentoleti\BudgetBundle\Entity\BudgetDetail $budgetDetails)
    {
        $this->budgetDetails[] = $budgetDetails;

        return $this;
    }

    /**
     * Remove budgetDetails
     *
     * @param \Dentoleti\BudgetBundle\Entity\BudgetDetail $budgetDetails
     */
    public function removeBudgetDetail(\Dentoleti\BudgetBundle\Entity\BudgetDetail $budgetDetails)
    {
        $this->budgetDetails->removeElement($budgetDetails);
    }

    /**
     * Get budgetDetails
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBudgetDetails()
    {
        return $this->budgetDetails;
    }
}
