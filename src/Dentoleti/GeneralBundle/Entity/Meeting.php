<?php

namespace Dentoleti\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meeting
 * @ORM\Table()
 * @ORM\Entity
 */
class Meeting
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
     * @ORM\Column(name="theway", type="string", length=50)
     */
    private $theway;


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
     * Set theway
     *
     * @param string $theway
     * @return Meeting
     */
    public function setTheway($theway)
    {
        $this->theway = $theway;

        return $this;
    }

    /**
     * Get theway
     *
     * @return string 
     */
    public function getTheway()
    {
        return $this->theway;
    }

    public function __toString()
    {
        return $this->getTheway();
    }
}
