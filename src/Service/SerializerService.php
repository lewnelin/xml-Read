<?php

namespace App\Service;

use App\Entity\Person;
use App\Serializer\PrefixPersonConverter;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class SerializerService
 * @package App\Service
 */
class SerializerService
{
    /**
     * @var Serializer
     */
    private $serializer;

    public function initSerializer(string $className)
    {
        $nameConverter = null;

        if ($className === Person::class) {
            $nameConverter = new PrefixPersonConverter();
        }

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $this->serializer = new Serializer(
            [new ObjectNormalizer($classMetadataFactory, $nameConverter)],
            [new XmlEncoder(), new JsonEncoder()]
        );
    }

    /**
     * @param array $data
     * @param array $options
     * @return string
     */
    public function serialize(array $data, array $options = []): string
    {
        return $this->serializer->serialize($data, 'json', $options);
    }

    /**
     * @param \SimpleXMLElement $xml
     * @param string $class
     * @param array $groups
     * @return object
     */
    public function deserialize(\SimpleXMLElement $xml, string $class, array $groups = ['groups' => ['upload']])
    {
        return $this->serializer->deserialize(
            $xml->asXML(),
            $class,
            'xml',
            $groups
        );
    }
}