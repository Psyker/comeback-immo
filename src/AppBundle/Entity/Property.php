<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Interfaces\PropertyInterface;
use AppBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Property
 *
 * @ORM\Table(name="property")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PropertyRepository")
 */
class Property implements PropertyInterface
{
    CONST PROPERTY_HOUSE = 'house';
    CONST PROPERTY_APARTMENT = 'appartement';

    /**
     * @var int
     *
     * @ORM\Column(name="aff_id", type="integer")
     * @ORM\Id
     */
    private $affId;

    /**
     * @var string $title
     * @ORM\Column(name="title", type="string", nullable=true)
     */
    private $title;

    /**
     * @var string $type
     * @ORM\Column(name="type", type="string")
     */
    private $type;

    /**
     * @var string $description
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var int $netPrice
     * @ORM\Column(name="net_price", type="integer")
     */
    private $netPrice;

    /**
     * @var Location $location
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Location", mappedBy="property", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id")
     */
    private $location;

    /**
     * @var PropertyInside $propertyInside
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\PropertyInside", mappedBy="property", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="inside_id", referencedColumnName="id")
     */
    private $propertyInside;

    /**
     * @var PropertyOutside $propertyOutside
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\PropertyOutside", mappedBy="property", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="outside_id", referencedColumnName="id")
     */
    private $propertyOutside;

    /**
     * @var PropertyOther $propertyOther
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\PropertyOther", mappedBy="property", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="other_id", referencedColumnName="id")
     */
    private $propertyOther;

    /**
     * @var PropertyArea $propertyArea
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\PropertyArea", mappedBy="property", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     */
    private $propertyArea;

    /**
     * @var \DateTime $createdAt
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     * @ORM\OrderBy("ASC")
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     * @ORM\Column(name="updated_at", type="date", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Media", mappedBy="property", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $medias;

    public function __construct()
    {
        $this->medias =  new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getAffId()
    {
        return $this->affId;
    }

    public function setAffId(int $affId)
    {
        $this->affId = $affId;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Property
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Property
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param PropertyInterface $location
     * @return Property
     */
    public function setLocation(PropertyInterface $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return PropertyInside
     */
    public function getPropertyInside()
    {
        return $this->propertyInside;
    }

    /**
     * @param PropertyInterface $propertyInside
     * @return Property
     */
    public function setPropertyInside(PropertyInterface $propertyInside)
    {
        $this->propertyInside = $propertyInside;

        return $this;
    }

    /**
     * @return PropertyOutside
     */
    public function getPropertyOutside()
    {
        return $this->propertyOutside;
    }

    /**
     * @param PropertyOutside $propertyOutside
     * @return Property
     */
    public function setPropertyOutside($propertyOutside)
    {
        $this->propertyOutside = $propertyOutside;

        return $this;
    }

    /**
     * @return PropertyOther
     */
    public function getPropertyOther()
    {
        return $this->propertyOther;
    }

    /**
     * @param PropertyInterface $propertyOther
     * @return Property
     */
    public function setPropertyOther($propertyOther)
    {
        $this->propertyOther = $propertyOther;

        return $this;
    }

    /**
     * @return PropertyArea
     */
    public function getPropertyArea()
    {
        return $this->propertyArea;
    }

    /**
     * @param PropertyArea $propertyArea
     * @return Property
     */
    public function setPropertyArea($propertyArea)
    {
        $this->propertyArea = $propertyArea;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Property
     * @throws \Exception
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = \DateTime::createFromFormat('Y-m-d H:i:s', $createdAt);

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Property
     * @throws \Exception
     */
    public function setUpdatedAt($updatedAt)
    {
        $updatedAt = str_replace('/', '-', $updatedAt);

        $this->updatedAt = \DateTime::createFromFormat('d-m-Y', $updatedAt);

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Property
     */
    public function setType(string $type): Property
    {
        $this->type = $type;

        return $this;
    }

    public function setMedias(array $medias)
    {
        $this->medias = $medias;

        return $this;
    }

    public function getMedias()
    {
        return $this->medias;
    }

    public function setAttribute($callback, $value)
    {
        $this->$callback($value);

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
     * Add media
     *
     * @param Media $media
     *
     * @return Property
     */
    public function addMedia(Media $media)
    {
        $this->medias[] = $media;

        return $this;
    }

    /**
     * Remove media
     *
     * @param Media $media
     */
    public function removeMedia(Media $media)
    {
        $this->medias->removeElement($media);
    }

    /**
     * @return int
     */
    public function getNetPrice(): int
    {
        return $this->netPrice;
    }

    /**
     * @param int $netPrice
     * @return Property
     */
    public function setNetPrice(int $netPrice): Property
    {
        $this->netPrice = $netPrice;

        return $this;
    }
}
