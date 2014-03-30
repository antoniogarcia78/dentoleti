<?php

namespace Dentoleti\BudgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BudgetDetail
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dentoleti\BudgetBundle\Entity\BudgetDetailRepository")
 */
class BudgetDetail
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set budget
     *
     * @param string $budget
     * @return BudgetDetail
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
     * Set article
     *
     * @param string $article
     * @return BudgetDetail
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return string 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return BudgetDetail
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
     * Set amount
     *
     * @param float $amount
     * @return BudgetDetail
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
     * Set tooth
     *
     * @param string $tooth
     * @return BudgetDetail
     */
    public function setTooth($tooth)
    {
        $this->tooth = $tooth;

        return $this;
    }

    /**
     * Get tooth
     *
     * @return string 
     */
    public function getTooth()
    {
        return $this->tooth;
    }

    /**
     * Method toString
     */
    public function __toString()
    {
        return "{$this->getId()}";
    }
}
