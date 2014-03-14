<?php

namespace Dentoleti\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Debt
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dentoleti\AccountingBundle\Entity\DebtRepository")
 */
class Debt
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
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @ORM\OneToOne(targetEntity="Dentoleti\TreatmentBundle\Entity\Treatment")
     * @ORM\JoinColumn(name="treatment_id", referencedColumnName="id")
     */
    private $treatment;


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
     * Set amount
     *
     * @param float $amount
     *
     * @return Debt
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set treatment
     *
     * @param string $treatment
     *
     * @return Debt
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
     * Method toString
     */    
    public function __toString()
    {
        return "Amount: " . $this->getAmount();
    }
}
