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
        if ($propertyName === 'phone') {
            return $propertyName;
        }

        return 'person' . $propertyName;
    }

    /**
     * @param string $propertyName
     * @return bool|string
     */
    public function denormalize($propertyName)
    {
        return 'person' === substr($propertyName, 0, 4) ? substr($propertyName, 4) : $propertyName;
    }
}