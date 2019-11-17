<?php
namespace App\Serializer;

use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

/**
 * Class PrefixPersonConverter
 * @package App\Serializer
 */
class PrefixPersonConverter implements NameConverterInterface
{
    /**
     * @param string $propertyName
     * @return string
     */
    public function normalize($propertyName)
    {
        return 'person' . $propertyName;
    }

    /**
     * @param string $propertyName
     * @return bool|string
     */
    public function denormalize($propertyName)
    {
        // removes 'org_' prefix
        return 'person' === substr($propertyName, 0, 4) ? substr($propertyName, 4) : $propertyName;
    }
}