<?php

namespace ABAPI\Tools;

use ReflectionClass;

class SchemesConverter
{
    public function toArray(): array
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties();
        $propertiesArray = [];

        foreach ($properties as $property) 
        {
            if (!$this->{$property->name}) {
                continue;
            }

            $propertiesArray[$property->name] = $this->{$property->name};
        }

        return $propertiesArray;
    }
}