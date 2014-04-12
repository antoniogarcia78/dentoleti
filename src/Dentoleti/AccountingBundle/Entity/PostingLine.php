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
 *  @Date:   2014-04-03 14:19:35
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:23:59
 * 
 */
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
     * @var string
     *
     * @ORM\Column(name="concept", type="string")
     */
    private $concept;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="postingLineDate", type="datetime")
     */
    private $postingLineDate;

    /**
     * @ORM\ManyToOne(targetEntity="Dentoleti\TreatmentBundle\Entity\Treatment")
     * @ORM\JoinColumn(name="treatment_id", referencedColumnName="id", nullable=true)
     */
    private $treatment;

    /**
     * @ORM\ManyToOne(targetEntity="Dentoleti\AccountingBundle\Entity\PaymentMethod")
     * @ORM\JoinColumn(name="payment_method_id", referencedColumnName="id")
     */
    private $method;

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

    /**
     * Set method
     *
     * @param string $method
     *
     * @return PostingLine
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get method
     *
     * @return string 
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set concept
     *
     * @param string $concept
     *
     * @return PostingLine
     */
    public function setConcept($concept)
    {
        $this->concept = $concept;

        return $this;
    }

    /**
     * Get concept
     *
     * @return string 
     */
    public function getConcept()
    {
        return $this->concept;
    }
}
