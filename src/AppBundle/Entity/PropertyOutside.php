<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\PropertyInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyOutside
 *
 * @ORM\Table(name="property_outside")
 * @ORM\Entity()
 */
class PropertyOutside implements PropertyInterface
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
     * @var bool
     * @ORM\Column(name="garden", type="boolean", nullable=true)
     */
    private $garden;

    /**
     * @var integer
     * @ORM\Column(name="year_of_construction", type="integer", nullable=true)
     */
    private $yearOfConstruction;


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
     * @return PropertyOutside
     */
    public function setProperty($property)
    {
        $this->property = $property;

        return $this;
    }

    /**
     * @return bool
     */
    public function isGarden()
    {
        return $this->garden;
    }

    /**
     * @param bool $garden
     * @return PropertyOutside
     */
    public function setGarden($garden)
    {
        $this->garden = $garden;

        return $this;
    }

    /**
     * @return int
     */
    public function getYearOfConstruction()
    {
        return $this->yearOfConstruction;
    }

    /**
     * @param int $yearOfConstruction
     * @return PropertyOutside
     */
    public function setYearOfConstruction($yearOfConstruction)
    {
        $this->yearOfConstruction = $yearOfConstruction;

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
     * Get garden
     *
     * @return boolean
     */
    public function getGarden()
    {
        return $this->garden;
    }
}
