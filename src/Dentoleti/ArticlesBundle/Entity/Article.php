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
 *      @Date:   2014-04-12 09:03:47
 *      @Last Modified by:   Luis González Rodríguez
 *      @Last Modified time: 2014-04-12 09:03:47
 * 
 */
namespace Dentoleti\ArticlesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dentoleti\ArticlesBundle\Entity\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="description", type="string", length=100)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="vat", type="float", nullable=true)
     */
    private $vat;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Family")
     * @ORM\JoinColumn(name="family_id", referencedColumnName="id", nullable=true)
     */
    private $family;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registrationDate", type="datetime")
     */
    private $registrationDate;

    /**
     * @ORM\OneToMany(targetEntity="Dentoleti\BudgetBundle\Entity\BudgetDetail", mappedBy="article")
     */
    private $budgetDetails;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;


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
     * Set description
     *
     * @param string $description
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Article
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set vat
     *
     * @param float $vat
     * @return Article
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return float 
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Set family
     *
     * @param string $family
     * @return Article
     */
    public function setFamily($family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return string 
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set registrationDate
     *
     * @param \DateTime $registrationDate
     * @return Article
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * Get registrationDate
     *
     * @return \DateTime 
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * Method toString
     */
    public function __toString()
    {
        return $this->getDescription();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->budgetDetails = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Article
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Add budgetDetails
     *
     * @param \Dentoleti\BudgetBundle\Entity\BudgetDetail $budgetDetails
     * @return Article
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
