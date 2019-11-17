<?php

namespace App\Service;

use App\Entity\Item;
use App\Entity\Person;
use App\Entity\Phone;
use App\Entity\ShipOrder;
use App\Serializer\PrefixOrderConverter;
use App\Serializer\PrefixPersonConverter;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Zend\EventManager\Exception\DomainException;

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
     * @var ShipOrderService
     */
    private $shipOrderService;

    /**
     * FileUploadService constructor.
     * @param PersonService $personService
     * @param ShipOrderService $shipOrderService
     * @param SerializerService $serializerService
     */
    public function __construct(
        PersonService $personService,
        ShipOrderService $shipOrderService,
        SerializerService $serializerService
    ) {
        $this->personService = $personService;
        $this->serializerService = $serializerService;
        $this->shipOrderService = $shipOrderService;
    }

    /**
     * @param UploadedFile $xmlFile
     */
    public function uploadXmlFile(UploadedFile $xmlFile)
    {
        $this->xmlValidate($xmlFile);

        $xml = new \SimpleXMLElement(file_get_contents($xmlFile->getRealPath()));

        $this->build($xml);
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
     * @param \SimpleXMLElement $xml,
     */
    private function build(\SimpleXMLElement $xml): void
    {
        if ($xml->getName() === 'people') {
            $this->buildPeople($xml);

            return;
        }

        if ($xml->getName() === 'shiporders') {
            $this->buildShipOrder($xml);

            return;
        }

        throw new DomainException('Invalid XML.');
    }

    /**
     * @param \SimpleXMLElement $xml
     */
    private function buildPeople(\SimpleXMLElement $xml): void
    {
        $this->serializerService->initSerializer(new PrefixPersonConverter());

        $people = new ArrayCollection();
        /** @var \SimpleXMLElement $personXml */
        foreach ($xml as $personXml) {
            /** @var Person $person */
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

    /**
     * @param \SimpleXMLElement $xml
     */
    private function buildShipOrder(\SimpleXMLElement $xml): void
    {
        $this->serializerService->initSerializer(new PrefixOrderConverter());

        $shipOrders = new ArrayCollection();
        /** @var \SimpleXMLElement $shipOrderXml */
        foreach ($xml as $shipOrderXml) {
            /** @var ShipOrder $shipOrder */
            $shipOrder = $this->serializerService->deserialize(
                $shipOrderXml,
                ShipOrder::class
            );

            $person = $this->personService->getPerson((int) $shipOrderXml->orderperson);

            if (!$person) {
                throw new DomainException('Invalid XML. People Xml yet to be uploaded.');
            }

            $shipOrder->setPerson($person);

            foreach ($shipOrderXml->items->item as $itemXml) {
                /** @var Item $item */
                $item = $this->serializerService->deserialize(
                    $itemXml,
                    Item::class
                );

                $shipOrder->addItem($item);
            }

            $shipOrders->add($shipOrder);
        }

        $this->shipOrderService->saveShipOrders($shipOrders);
    }
}