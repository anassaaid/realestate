<?php

namespace AppBundle\Service;

class SerializerCircularReference
{
    public function __invoke($object)
    {
        return $object->getId();
    }
}