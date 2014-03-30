<?php

namespace Dentoleti\TreatmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Treatment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dentoleti\TreatmentBundle\Entity\TreatmentRepository")
 */
class Treatment
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
     * @var \DateTime
     *
     * @ORM\Column(name="treatmentDate", type="datetime")
     */
    private $treatmentDate;

    /**
     * @ORM\OneToOne(targetEntity="Dentoleti\BudgetBundle\Entity\Budget")
     * @ORM\JoinColumn(name="budget_id", referencedColumnName="id", nullable=true)
     */
    private $budget;

    /**
     * @var string
     *
     * @ORM\Column(name="noTooth", type="text")
     */
    private $noTooth;

    /**
     * @var float
     *
     * @ORM\Column(name="financingCosts", type="float")
     */
    private $financingCosts;

    /**
     * @var boolean
     *
     * @ORM\Column(name="funded", type="boolean")
     */
    private $funded;


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
     * Set treatmentDate
     *
     * @param \DateTime $treatmentDate
     *
     * @return Treatment
     */
    public function setTreatmentDate($treatmentDate)
    {
        $this->treatmentDate = $treatmentDate;

        return $this;
    }

    /**
     * Get treatmentDate
     *
     * @return \DateTime 
     */
    public function getTreatmentDate()
    {
        return $this->treatmentDate;
    }

    /**
     * Set budget
     *
     * @param string $budget
     *
     * @return Treatment
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return string 
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set noTooth
     *
     * @param string $noTooth
     *
     * @return Treatment
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
     * Set financingCosts
     *
     * @param float $financingCosts
     *
     * @return Treatment
     */
    public function setFinancingCosts($financingCosts)
    {
        $this->financingCosts = $financingCosts;

        return $this;
    }

    /**
     * Get financingCosts
     *
     * @return float 
     */
    public function getFinancingCosts()
    {
        return $this->financingCosts;
    }

    /**
     * Set funded
     *
     * @param boolean $funded
     *
     * @return Treatment
     */
    public function setFunded($funded)
    {
        $this->funded = $funded;

        return $this;
    }

    /**
     * Get funded
     *
     * @return boolean 
     */
    public function getFunded()
    {
        return $this->funded;
    }

    /**
     * Method toString
     */
    public function __toString()
    {
        return $this->getBudget();
    }
}
