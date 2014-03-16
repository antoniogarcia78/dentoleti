<?php

namespace Dentoleti\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostingLine
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dentoleti\AccountingBundle\Entity\PostingLineRepository")
 */
class PostingLine
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
     * @var \DateTime
     *
     * @ORM\Column(name="postingLineDate", type="datetime")
     */
    private $postingLineDate;

    /**
     * @ORM\ManyToOne(targetEntity="Dentoleti\TreatmentBundle\Entity\Treatment")
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
     * @return PostingLine
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
     * Set postingLineDate
     *
     * @param \DateTime $postingLineDate
     *
     * @return PostingLine
     */
    public function setPostingLineDate($postingLineDate)
    {
        $this->postingLineDate = $postingLineDate;

        return $this;
    }

    /**
     * Get postingLineDate
     *
     * @return \DateTime 
     */
    public function getPostingLineDate()
    {
        return $this->postingLineDate;
    }

    /**
     * Set treatment
     *
     * @param string $treatment
     *
     * @return PostingLine
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
}
