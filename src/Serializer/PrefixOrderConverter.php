<?php
namespace App\Serializer;

use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

/**
 * Class PrefixPersonConverter
 * @package App\Serializer
 */
class PrefixOrderConverter implements NameConverterInterface
{
    /**
     * @param string $propertyName
     * @return string
     */
    public function normalize($propertyName)
    {
        if (in_array($propertyName, ['shipto', 'items'])) {
            return $propertyName;
        }

        return 'order' . $propertyName;
    }

    /**
     * @param string $propertyName
     * @return bool|string
     */
    public function denormalize($propertyName)
    {
        return 'order' === substr($propertyName, 0, 4) ? substr($propertyName, 4) : $propertyName;
    }
}