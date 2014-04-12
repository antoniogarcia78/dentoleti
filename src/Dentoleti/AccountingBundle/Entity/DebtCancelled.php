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
 *  @Date:   2014-04-03 12:31:09
 *  @Last Modified by:   Luis González Rodríguez
 *  @Last Modified time: 2014-04-12 08:23:51
 * 
 */
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
