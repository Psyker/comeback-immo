<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\PropertyInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyInside
 *
 * @ORM\Table(name="property_inside")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PropertyInsideRepository")
 */
class PropertyInside implements PropertyInterface
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
     * @var int $roomQuantity
     * @ORM\Column(name="room_quantity", type="integer", nullable=true)
     */
    private $roomQuantity;

    /**
     * @var int $bedroomQuantity
     * @ORM\Column(name="bedroom_quantity", type="integer", nullable=true)
     */
    private $bedroomQuantity;

    /**
     * @var int $bathroomQuantity
     * @ORM\Column(name="bathroom_quantity", type="integer", nullable=true)
     */
    private $bathroomQuantity;

    /**
     * @var int $washroomQuantity
     * @ORM\Column(name="washroom_quantity", type="integer", nullable=true)
     */
    private $washroomQuantity;

    /**
     * @var int $toiletQuantity
     * @ORM\Column(name="toilet_quantity", type="integer", nullable=true)
     */
    private $toiletQuantity;

    /**
     * @var string $kitchen
     * @ORM\Column(name="kitchen", type="string", nullable=true)
     */
    private $kitchen;

    /**
     * @var string $heatingType
     * @ORM\Column(name="heating_type", type="string", nullable=true)
     */
    private $heatingType;

    /**
     * @var int $floorNumber
     * @ORM\Column(name="floor_number", type="integer", nullable=true)
     */
    private $floorNumber;


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
     * @return PropertyInside
     */
    public function setProperty($property)
    {
        $this->property = $property;

        return $this;
    }

    /**
     * @return int
     */
    public function getRoomQuantity()
    {
        return $this->roomQuantity;
    }

    /**
     * @param int $roomQuantity
     * @return PropertyInside
     */
    public function setRoomQuantity($roomQuantity)
    {
        $this->roomQuantity = $roomQuantity;

        return $this;
    }

    /**
     * @return int
     */
    public function getBedroomQuantity()
    {
        return $this->bedroomQuantity;
    }

    /**
     * @param int $bedroomQuantity
     * @return PropertyInside
     */
    public function setBedroomQuantity($bedroomQuantity)
    {
        $this->bedroomQuantity = $bedroomQuantity;

        return $this;
    }

    /**
     * @return int
     */
    public function getBathroomQuantity()
    {
        return $this->bathroomQuantity;
    }

    /**
     * @param int $bathroomQuantity
     * @return PropertyInside
     */
    public function setBathroomQuantity($bathroomQuantity)
    {
        $this->bathroomQuantity = $bathroomQuantity;

        return $this;
    }

    /**
     * @return int
     */
    public function getWashroomQuantity()
    {
        return $this->washroomQuantity;
    }

    /**
     * @param int $washroomQuantity
     * @return PropertyInside
     */
    public function setWashroomQuantity($washroomQuantity)
    {
        $this->washroomQuantity = $washroomQuantity;

        return $this;
    }

    /**
     * @return int
     */
    public function getToiletQuantity()
    {
        return $this->toiletQuantity;
    }

    /**
     * @param int $toiletQuantity
     * @return PropertyInside
     */
    public function setToiletQuantity($toiletQuantity)
    {
        $this->toiletQuantity = $toiletQuantity;

        return $this;
    }

    /**
     * @return string
     */
    public function getKitchen()
    {
        return $this->kitchen;
    }

    /**
     * @param string $kitchen
     * @return PropertyInside
     */
    public function setKitchen($kitchen)
    {
        $this->kitchen = $kitchen;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeatingType()
    {
        return $this->heatingType;
    }

    /**
     * @param string $heatingType
     * @return PropertyInside
     */
    public function setHeatingType($heatingType)
    {
        $this->heatingType = $heatingType;

        return $this;
    }

    /**
     * @return int
     */
    public function getFloorNumber(): int
    {
        return $this->floorNumber;
    }

    /**
     * @param int $floorNumber
     * @return PropertyInside
     */
    public function setFloorNumber($floorNumber): PropertyInside
    {
        $this->floorNumber = $floorNumber;

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
}
