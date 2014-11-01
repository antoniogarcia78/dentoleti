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
 *      @Date:   2014-04-13 10:15:13
 *      @Last Modified by:   Luis González Rodríguez
 *      @Last Modified time: 2014-04-13 10:15:13
 * 
 */
namespace Dentoleti\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InitialAccounting
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dentoleti\AccountingBundle\Entity\InitialAccountingRepository")
 */
class InitialAccounting
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
     * @ORM\Column(name="accountingDate", type="datetime")
     */
    private $accountingDate;


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
     * @return InitialAccounting
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
     * Set accountingDate
     *
     * @param \DateTime $accountingDate
     *
     * @return InitialAccounting
     */
    public function setAccountingDate($accountingDate)
    {
        $this->accountingDate = $accountingDate;

        return $this;
    }

    /**
     * Get accountingDate
     *
     * @return \DateTime 
     */
    public function getAccountingDate()
    {
        return $this->accountingDate;
    }

    /**
     * Method toString
     */
    public function __toString()
    {
        return strval($this->getAmount());
    }
}

