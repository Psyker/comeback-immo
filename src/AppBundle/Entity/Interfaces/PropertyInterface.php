<?php

namespace AppBundle\Entity\Interfaces;

interface PropertyInterface
{

    public function set(string $functionName, $value): PropertyInterface;

    public function get(string $functionName): PropertyInterface;

}