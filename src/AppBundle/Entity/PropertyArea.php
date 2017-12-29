<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\PropertyInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyOutside
 *
 * @ORM\Table(name="property_area")
 * @ORM\Entity()
 */
class PropertyArea implements PropertyInterface
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
     * @var int $area
     * @ORM\Column(name="area", type="integer", nullable=true)
     */
    private $area;

    /**
     * @var float $livingRoomArea
     * @ORM\Column(name="living_room_area", type="float", nullable=true)
     */
    private $livingRoomArea;

    /**
     * @var int $terraceArea
     * @ORM\Column(name="terrace_area", type="integer", nullable=true)
     */
    private $terraceArea;

    /**
     * @var int $landArea
     * @ORM\Column(name="land_area", type="integer", nullable=true)
     */
    private $landArea;

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
     * @return int
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param int $area
     * @return PropertyArea
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * @return float
     */
    public function getLivingRoomArea()
    {
        return $this->livingRoomArea;
    }

    /**
     * @param float $livingRoomArea
     * @return PropertyArea
     */
    public function setLivingRoomArea($livingRoomArea)
    {
        $this->livingRoomArea = $livingRoomArea;

        return $this;
    }

    /**
     * @return int
     */
    public function getTerraceArea()
    {
        return $this->terraceArea;
    }

    /**
     * @param int $terraceArea
     * @return PropertyArea
     */
    public function setTerraceArea($terraceArea)
    {
        $this->terraceArea = $terraceArea;

        return $this;
    }

    /**
     * @return int
     */
    public function getLandArea()
    {
        return $this->landArea;
    }

    /**
     * @param int $landArea
     * @return PropertyArea
     */
    public function setLandArea($landArea)
    {
        $this->landArea = $landArea;

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
