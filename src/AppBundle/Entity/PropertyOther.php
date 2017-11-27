<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyOther
 *
 * @ORM\Table(name="property_other")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PropertyOtherRepository")
 */
class PropertyOther
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
     * @var Property $property
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Property", inversedBy="propertyOther")
     * @ORM\JoinColumn(name="property_id", referencedColumnName="aff_id")
     */
    private $property;

    /**
     * @var bool $elevator
     * @ORM\Column(name="elevator", type="boolean")
     */
    private $elevator;

    /**
     * @var int $cellar
     * @ORM\Column(name="cellar", type="integer")
     */
    private $cellar;

    /**
     * @var int $parkingSpot
     * @ORM\Column(name="parking_spot", type="integer")
     */
    private $parkingSpot;

    /**
     * @var int $garageQuantity
     * @ORM\Column(name="garage_quantity", type="integer")
     */
    private $garageQuantity;

    /**
     * @var boolean $intercom
     * @ORM\Column(name="intercom", type="boolean")
     */
    private $intercom;

    /**
     * @var boolean $digicode
     * @ORM\Column(name="digicode", type="boolean")
     */
    private $digicode;

    /**
     * @var boolean $basement
     * @ORM\Column(name="basement", type="boolean")
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
     * @return Property
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param Property $property
     * @return PropertyOther
     */
    public function setProperty($property)
    {
        $this->property = $property;

        return $this;
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
}
