<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\PropertyInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LocationRepository")
 */
class Location implements PropertyInterface
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
     * @var int $zipCode
     * @ORM\Column(name="zip_code", name="zip_code")
     */
    private $zipCode;

    /**
     * @var string $city
     * @ORM\Column(name="city", type="string")
     */
    private $city;

    /**
     * @var string $country
     * @ORM\Column(name="country", type="string")
     */
    private $country;

    /**
     * @var int $shopProximity
     * @ORM\Column(name="shop_proximity", type="integer", nullable=true)
     */
    private $shopProximity;

    /**
     * @var int $busProximity
     * @ORM\Column(name="bus_proximity", type="integer", nullable=true)
     */
    private $busProximity;

    /**
     * @var int $floorQuantity
     * @ORM\Column(name="floor_quantity", type="integer")
     */
    private $floorQuantity;



    /**
     * @var Property $property
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Property", inversedBy="location")
     * @ORM\JoinColumn(name="property_id", referencedColumnName="aff_id")
     */
    private $property;

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
    public function getZipCode(): int
    {
        return $this->zipCode;
    }

    /**
     * @param int $zipCode
     * @return Location
     */
    public function setZipCode(int $zipCode): Location
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Location
     */
    public function setCity(string $city): Location
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return int
     */
    public function getShopProximity(): int
    {
        return $this->shopProximity;
    }

    /**
     * @param int $shopProximity
     * @return Location
     */
    public function setShopProximity($shopProximity): Location
    {
        $this->shopProximity = $shopProximity;

        return $this;
    }

    /**
     * @return int
     */
    public function getBusProximity(): int
    {
        return $this->busProximity;
    }

    /**
     * @param int $busProximity
     * @return Location
     */
    public function setBusProximity($busProximity): Location
    {
        $this->busProximity = $busProximity;

        return $this;
    }

    /**
     * @return Property
     */
    public function getProperty(): Property
    {
        return $this->property;
    }

    /**
     * @param Property $property
     * @return Location
     */
    public function setProperty(Property $property): Location
    {
        $this->property = $property;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Location
     */
    public function setCountry(string $country): Location
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return int
     */
    public function getFloorQuantity(): int
    {
        return $this->floorQuantity;
    }

    /**
     * @param int $floorQuantity
     * @return Location
     */
    public function setFloorQuantity(int $floorQuantity): Location
    {
        $this->floorQuantity = $floorQuantity;

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
