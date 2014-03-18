<?php

namespace Dentoleti\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DebtCancelled
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DebtCancelled
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
     * @ORM\Column(name="cancellationDate", type="datetime")
     */
    private $cancellationDate;

    /**
     * @ORM\OneToOne(targetEntity="Dentoleti\AccountingBundle\Entity\Debt")
     * @ORM\JoinColumn(name="debt_id", referencedColumnName="id")
     */
    private $debt;

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
     * Set cancellationDate
     *
     * @param \DateTime $cancellationDate
     *
     * @return DebtCancelled
     */
    public function setCancellationDate($cancellationDate)
    {
        $this->cancellationDate = $cancellationDate;

        return $this;
    }

    /**
     * Get cancellationDate
     *
     * @return \DateTime 
     */
    public function getCancellationDate()
    {
        return $this->cancellationDate;
    }

    /**
     * Set debt
     *
     * @param \Dentoleti\AccountingBundle\Entity\Debt $debt
     *
     * @return DebtCancelled
     */
    public function setDebt(\Dentoleti\AccountingBundle\Entity\Debt $debt = null)
    {
        $this->debt = $debt;

        return $this;
    }

    /**
     * Get debt
     *
     * @return \Dentoleti\AccountingBundle\Entity\Debt 
     */
    public function getDebt()
    {
        return $this->debt;
    }
}
