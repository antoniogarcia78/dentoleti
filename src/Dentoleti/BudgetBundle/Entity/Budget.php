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
 *  
 *  @Author: Luis González Rodríguez
 *  @Date:   2014-04-06 07:19:51
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:33:19
 * 
 */
<?php
namespace Dentoleti\BudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Budget
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dentoleti\BudgetBundle\Entity\BudgetRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\ManyToOne(targetEntity="Dentoleti\PatientBundle\Entity\Patient",cascade={"persist"})
     * @ORM\JoinColumn(name="patient_id", referencedColumnName="id", nullable=true, unique=false)
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
     * @ORM\ManyToOne(targetEntity="Dentoleti\PersonalBundle\Entity\Doctor",cascade={"persist"})
     * @ORM\JoinColumn(name="doctor_id", referencedColumnName="id", nullable=true, unique=false)
     */
    private $doctor;

    /**
     * @var float
     *
     * @ORM\Column(name="discount", type="float", nullable=true)
     */
    private $discount;

    /**
     * @var string
     *
     * @ORM\Column(name="observations", type="text", nullable=true)
     */
    private $observations;

    /**
     * @var float
     *
     * @ORM\Column(name="discountCompany", type="float", nullable=true)
     */
    private $discountCompany;

    /**
     * @var float
     *
     * @ORM\Column(name="discountInsurance", type="float", nullable=true)
     */
    private $discountInsurance;

    /**
     * @ORM\OneToMany(targetEntity="BudgetDetail", mappedBy="budget")
     */
    private $budgetDetails;

    /**
     * @var boolean
     *
     * @ORM\Column(name="confirmed", type="boolean")
     */
    private $confirmed;

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
     * Method toString
     */
    public function __toString()
    {
        return strval($this->getId());
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

    /**
     * @ORM\PrePersist()
     */
    public function preSetDate()
    {
        $this->setBudgetDate(new \DateTime());
    }

    /**
     * Set confirmed
     *
     * @param boolean $confirmed
     *
     * @return Budget
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * Get confirmed
     *
     * @return boolean 
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }
}
