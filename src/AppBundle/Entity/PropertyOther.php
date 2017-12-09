<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\PropertyInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyOther
 *
 * @ORM\Table(name="property_other")
 * @ORM\Entity()
 */
class PropertyOther implements PropertyInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var bool $elevator
     * @ORM\Column(name="elevator", type="boolean", nullable=true)
     */
    private $elevator;

    /**
     * @var int $cellar
     * @ORM\Column(name="cellar", type="integer", nullable=true)
     */
    private $cellar;

    /**
     * @var int $parkingSpot
     * @ORM\Column(name="parking_spot", type="integer", nullable=true)
     */
    private $parkingSpot;

    /**
     * @var int $garageQuantity
     * @ORM\Column(name="garage_quantity", type="integer", nullable=true)
     */
    private $garageQuantity;

    /**
     * @var boolean $intercom
     * @ORM\Column(name="intercom", type="boolean", nullable=true)
     */
    private $intercom;

    /**
     * @var boolean $digicode
     * @ORM\Column(name="digicode", type="boolean", nullable=true)
     */
    private $digicode;

    /**
     * @var boolean $basement
     * @ORM\Column(name="basement", type="boolean", nullable=true)
     */
    private $basement;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isElevator()
    {
        return $this->elevator;
    }

    /**
     * @param bool $elevator
     * @return PropertyOther
     */
    public function setElevator($elevator)
    {
        $this->elevator = $elevator;

        return $this;
    }

    /**
     * @return int
     */
    public function getCellar()
    {
        return $this->cellar;
    }

    /**
     * @param int $cellar
     * @return PropertyOther
     */
    public function setCellar($cellar)
    {
        $this->cellar = $cellar;

        return $this;
    }

    /**
     * @return int
     */
    public function getParkingSpot()
    {
        return $this->parkingSpot;
    }

    /**
     * @param int $parkingSpot
     * @return PropertyOther
     */
    public function setParkingSpot($parkingSpot)
    {
        $this->parkingSpot = $parkingSpot;

        return $this;
    }

    /**
     * @return int
     */
    public function getGarageQuantity()
    {
        return $this->garageQuantity;
    }

    /**
     * @param int $garageQuantity
     * @return PropertyOther
     */
    public function setGarageQuantity($garageQuantity)
    {
        $this->garageQuantity = $garageQuantity;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIntercom()
    {
        return $this->intercom;
    }

    /**
     * @param bool $intercom
     * @return PropertyOther
     */
    public function setIntercom($intercom)
    {
        $this->intercom = $intercom;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDigicode()
    {
        return $this->digicode;
    }

    /**
     * @param bool $digicode
     * @return PropertyOther
     */
    public function setDigicode($digicode)
    {
        $this->digicode = $digicode;

        return $this;
    }

    /**
     * @return bool
     */
    public function isBasement()
    {
        return $this->basement;
    }

    /**
     * @param bool $basement
     * @return PropertyOther
     */
    public function setBasement($basement)
    {
        $this->basement = $basement;

        return $this;
    }

    public function set(string $functionName, $value): PropertyInterface
    {
       $this->$functionName($value);

       return $this;
    }

    public function get(string $functionName): PropertyInterface
    {
        // TODO: Implement get() method.
    }

    /**
     * Get elevator
     *
     * @return boolean
     */
    public function getElevator()
    {
        return $this->elevator;
    }

    /**
     * Get intercom
     *
     * @return boolean
     */
    public function getIntercom()
    {
        return $this->intercom;
    }

    /**
     * Get digicode
     *
     * @return boolean
     */
    public function getDigicode()
    {
        return $this->digicode;
    }

    /**
     * Get basement
     *
     * @return boolean
     */
    public function getBasement()
    {
        return $this->basement;
    }
}
