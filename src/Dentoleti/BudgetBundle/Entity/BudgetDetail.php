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
 *      @Date:   2014-04-12 09:26:43
 *      @Last Modified by:   Luis González Rodríguez
 *      @Last Modified time: 2014-04-12 09:26:43
 * 
 */
namespace Dentoleti\BudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BudgetDetail
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dentoleti\BudgetBundle\Entity\BudgetDetailRepository")
 */
class BudgetDetail {
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
   * @ORM\ManyToOne(targetEntity="Dentoleti\BudgetBundle\Entity\Budget", inversedBy="budgetDetails",cascade={"persist"})
   * @ORM\JoinColumn(name="budget_id", referencedColumnName="id")
   */
  private $budget;

  /**
   *
   * @ORM\ManyToOne(targetEntity="Dentoleti\ArticlesBundle\Entity\Article", inversedBy="budgetDetails",cascade={"persist"})
   * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=true)
   */
  private $article;

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
   * @var float
   *
   * @ORM\Column(name="amount", type="float")
   */
  private $amount;

  /**
   * @var string
   *
   * @ORM\Column(name="tooth", type="string", length=50, nullable=true)
   */
  private $tooth;

  /**
   * @var boolean
   *
   * @ORM\Column(name="done", type="boolean", nullable=true)
   */
  private $done;

  /**
   * @var float
   *
   * @ORM\Column(name="labexpense", type="float", nullable=true)
   */
  private $labExpense;

  /**
   * Get id
   *
   * @return integer
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set budget
   *
   * @param string $budget
   * @return BudgetDetail
   */
  public function setBudget($budget) {
    $this->budget = $budget;

    return $this;
  }

  /**
   * Get budget
   *
   * @return string
   */
  public function getBudget() {
    return $this->budget;
  }

  /**
   * Set article
   *
   * @param string $article
   * @return BudgetDetail
   */
  public function setArticle($article) {
    $this->article = $article;

    return $this;
  }

  /**
   * Get article
   *
   * @return string
   */
  public function getArticle() {
    return $this->article;
  }

  /**
   * Set price
   *
   * @param float $price
   * @return BudgetDetail
   */
  public function setPrice($price) {
    $this->price = $price;

    return $this;
  }

  /**
   * Get price
   *
   * @return float
   */
  public function getPrice() {
    return $this->price;
  }

  /**
   * Set amount
   *
   * @param float $amount
   * @return BudgetDetail
   */
  public function setAmount($amount) {
    $this->amount = $amount;

    return $this;
  }

  /**
   * Get amount
   *
   * @return float
   */
  public function getAmount() {
    return $this->amount;
  }

  /**
   * Set tooth
   *
   * @param string $tooth
   * @return BudgetDetail
   */
  public function setTooth($tooth) {
    $this->tooth = $tooth;

    return $this;
  }

  /**
   * Get tooth
   *
   * @return string
   */
  public function getTooth() {
    return $this->tooth;
  }

  /**
   * Method toString
   */
  public function __toString() {
    return "{$this->getId()}";
  }

  /**
   * Set done
   *
   * @param boolean $done
   *
   * @return BudgetDetail
   */
  public function setDone($done) {
    $this->done = $done;

    return $this;
  }

  /**
   * Get done
   *
   * @return boolean
   */
  public function getDone() {
    return $this->done;
  }

  /**
   * Set labExpense
   *
   * @param float $labExpense
   * @return BudgetDetail
   */
  public function setLabExpense($labExpense) {
    $this->labExpense = $labExpense;

    return $this;
  }

  /**
   * Get labExpense
   *
   * @return float
   */
  public function getLabExpense() {
    return $this->labExpense;
  }

  /**
   * Set vat
   *
   * @param float $vat
   * @return BudgetDetail
   */
  public function setVat($vat) {
    $this->vat = $vat;

    return $this;
  }

  /**
   * Get vat
   *
   * @return float
   */
  public function getVat() {
    return $this->vat;
  }
}
