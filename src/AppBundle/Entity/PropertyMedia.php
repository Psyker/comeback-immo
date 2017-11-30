<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyMedia
 *
 * @ORM\Table(name="property_media")
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

