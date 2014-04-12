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
 *  @Last Modified time: 2014-04-12 08:48:24
 * 
 */
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
     * @var float
     *
     * @ORM\Column(name="financingCosts", type="float", nullable=true)
     */
    private $financingCosts;

    /**
     * @var boolean
     *
     * @ORM\Column(name="funded", type="boolean", nullable=true)
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
        return strval($this->getBudget());
    }
}
