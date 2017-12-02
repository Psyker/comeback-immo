<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyMedia
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PropertyMediaRepository")
 */
class PropertyMedia
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
     * @var string $imageUrl
     * @ORM\Column(type="string", name="image_url")
     */
    private $imageUrl;

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
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     * @return PropertyMedia
     */
    public function setImageUrl(string $imageUrl): PropertyMedia
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
}

