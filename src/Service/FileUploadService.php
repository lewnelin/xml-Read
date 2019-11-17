<?php

namespace App\Service;

use App\Entity\Person;
use App\Entity\Phone;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
     * @var SerializerService
     */
    private $serializerService;

    /**
     * FileUploadService constructor.
     * @param PersonService $personService
     * @param SerializerService $serializerService
     */
    public function __construct(PersonService $personService, SerializerService $serializerService)
    {
        $this->personService = $personService;
        $this->serializerService = $serializerService;
    }

    /**
     * @param UploadedFile $xmlFile
     */
    public function uploadXmlFile(UploadedFile $xmlFile)
    {
        $this->xmlValidate($xmlFile);

        $xml = new \SimpleXMLElement(file_get_contents($xmlFile->getRealPath()));
        $this->serializerService->initSerializer();

        $this->buildPeople($xml);
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

    /**
     * @param \SimpleXMLElement $xml
     */
    private function buildPeople(\SimpleXMLElement $xml): void
    {
        $people = new ArrayCollection();
        /** @var \SimpleXMLElement $personXml */
        foreach ($xml as $personXml) {
            $person = $this->serializerService->deserialize(
                $personXml,
                Person::class
            );

            foreach ($personXml->phones->phone as $phone) {
                $phone = new Phone($phone);
                $phone->setPerson($person);
            }

            $people->add($person);
        }

        $this->personService->savePeople($people);
    }
}