<?php

namespace App\Service;

use App\Entity\Person;
use App\Serializer\PrefixPersonConverter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class FileUploadService
 * @package App\Service
 */
class FileUploadService
{
    /**
     * @var PersonService
     */
    private $personService;

    /**
     * FileUploadService constructor.
     * @param PersonService $personService
     */
    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    /**
     * @param UploadedFile $xmlFile
     */
    public function uploadXmlFile(UploadedFile $xmlFile)
    {
        $this->xmlValidate($xmlFile);

        $xml = new \SimpleXMLElement(file_get_contents($xmlFile->getRealPath()));
        $nameConverter = new PrefixPersonConverter();
        $serializer = new Serializer(
            [new ObjectNormalizer(null, $nameConverter), new ArrayDenormalizer()],
            [new XmlEncoder(), new JsonEncoder()]
        );

        $people = new ArrayCollection();
        /** @var \SimpleXMLElement $personXml */
        foreach ($xml as $personXml) {
            $person = $serializer->deserialize($personXml->asXML(), Person::class, 'xml');
            $people->add($person);
        }

        $this->personService->savePeople($people);
    }

    /**
     * @param UploadedFile $xmlFile
     */
    private function xmlValidate(UploadedFile $xmlFile)
    {
        if ($xmlFile->guessExtension() !== 'xml') {
            throw new \DomainException('Invalid file upload');
        }
    }
}