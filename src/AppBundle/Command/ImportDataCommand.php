<?php

namespace AppBundle\Command;

use AppBundle\Entity\Interfaces\PropertyInterface;
use AppBundle\Entity\Location;
use AppBundle\Entity\Property;
use AppBundle\Entity\PropertyArea;
use AppBundle\Entity\PropertyInside;
use AppBundle\Entity\PropertyMedia;
use AppBundle\Entity\PropertyOther;
use AppBundle\Entity\PropertyOutside;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportDataCommand extends ContainerAwareCommand
{

    private $propertyModel = [
        'INFO_GENERALES' => [
            'AFF_ID' => 'setAffId',
            'DATE_CREATION' => 'setCreatedAt',
            'DATE_MAJ' => 'setUpdatedAt',
        ],
    ];

    private $locationModel = [
        'LOCALISATION' => [
            'CODE_POSTAL' => 'setZipCode',
            'VILLE' => 'setCity',
            'PAYS' => 'setCountry',
            'PROXIMITE' => [
                'COMMERCES' => 'setShopProximity',
                'BUS' => 'setBusProximity',
            ],
        ],
        'APPARTEMENT' => [
            'NUM_ETAGE' => 'setFloorQuantity',
        ],
    ];

    private $propertyInsideModel = [
        'MAISON' => [
            'NBRE_PIECES' => 'setRoomQuantity',
            'NBRE_CHAMBRES' => 'setBedroomQuantity',
            'NBRE_SALLE_BAIN' => 'setBathroomQuantity',
            'NBRE_SALLE_EAU' => 'setWashroomQuantity',
            'NBRE_WC' => 'setToiletQuantity',
            'CUISINE' => 'setKitchen',
            'MODE_CHAUFFAGE' => 'setHeatingType',
            'NBRE_ETAGE' => 'setFloorNumber',
        ],
        'APPARTEMENT' => [
            'NBRE_PIECES' => 'setRoomQuantity',
            'NBRE_CHAMBRES' => 'setBedroomQuantity',
            'NBRE_SALLE_BAIN' => 'setBathroomQuantity',
            'NBRE_SALLE_EAU' => 'setWashroomQuantity',
            'NBRE_WC' => 'setToiletQuantity',
            'CUISINE' => 'setKitchen',
            'MODE_CHAUFFAGE' => 'setHeatingType',
            'NBRE_ETAGE' => 'setFloorNumber',
        ],
    ];

    private $propertyOutsideModel = [
        'MAISON' => [
            'JARDIN' => 'setGarden',
            'ANNEE_CONSTRUCTION' => 'setYearOfConstruction',
        ],
        'APPARTEMENT' => [
            'JARDIN' => 'setGarden',
            'ANNEE_CONSTRUCTION' => 'setYearOfConstruction',
        ],
    ];

    private $propertyOtherModel = [
        'MAISON' => [
            'ASCENSEUR' => 'setElevator',
            'SOUS_SOL' => 'setBasement',
            'NBRE_GARAGE' => 'setGarageQuantity',
            'NBRE_CAVES' => 'setCellar',
            'INTERPHONE' => 'setIntercom',
            'NBRE_PARKING' => 'setParkingSpot',
        ],
        'APPARTMEMENT' => [
            'ASCENSEUR' => 'setElevator',
            'NBRE_GARAGE' => 'setGarageQuantity',
            'SOUS_SOL' => 'setBasement',
            'NBRE_CAVES' => 'setCellar',
            'INTERPHONE' => 'setIntercom',
            'NBRE_PARKING' => 'setParkingSpot',
        ],
    ];

    private $propertyAreaModel = [
        'MAISON' => [
            'SURFACE_HABITABLE' => 'setArea',
            'SURFACE_SEJOUR' => 'setLivingRoomArea',
            'SURFACE_TERRASSE' => 'setTerraceArea',
            'SURFACE_TERRAIN' => 'setLandArea'
        ],
    ];
    private $em;

    public function __construct(EntityManager $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:data:import')
            ->setDescription('Import all the data from xml export.');
    }

    private function setDataByModel(array $model, array $data, PropertyInterface $entity)
    {
        foreach ($model as $key => $attributeCategory) {
            if (array_key_exists($key, $data)) {
                foreach ($attributeCategory as $keyAttribute => $attribute) {
                    if (is_array($attribute)) {
                        foreach($attribute as $keyNestedAttribute => $nestedAttribute) {
                            if (array_key_exists($keyNestedAttribute, $data[$key][$keyAttribute])) {
                                $entity->set($nestedAttribute, $data[$key][$keyAttribute][$keyNestedAttribute]);
                            }
                        }
                    } else {
                        if (array_key_exists($keyAttribute, $data[$key])) {
                            $entity->set($attribute, $data[$key][$keyAttribute]);
                        }
                    }
                }
            }
        }

        return $entity;
    }

//    private function getImagesByProperty(Property $property, array $data)
//    {
//        foreach ($data['IMAGES']['IMG'] as $image) {
//            $property->addPropertyMedia((new PropertyMedia())->setImageUrl($image));
//        }
//    }

    private function createProperties(array $newProperties) {
        foreach ($newProperties as $data) {
            /** @var Property $property */
            $property = $this->setDataByModel($this->propertyModel, $data, new Property());
            if (array_key_exists('MAISON', $data)) {
                $property->setType(Property::PROPERTY_HOUSE);
            } else {
                $property->setType(Property::PROPERTY_APARTMENT);
            }

            /** @var Location $location */
            $location = $this->setDataByModel($this->locationModel, $data, new Location());
            $location->setProperty($property);

            /** @var PropertyInside $propertyInside */
            $propertyInside = $this->setDataByModel($this->propertyInsideModel, $data, new PropertyInside());
            $propertyInside->setProperty($property);

            /** @var PropertyOutside $propertyOutside */
            $propertyOutside = $this->setDataByModel($this->propertyOutsideModel, $data, new PropertyOutside());
            $propertyOutside->setProperty($property);

            /** @var PropertyOutside $propertyOther */
            $propertyOther = $this->setDataByModel($this->propertyOtherModel, $data, new PropertyOther());
            $propertyOther->setProperty($property);

            /** @var PropertyArea $propertyArea */
            $propertyArea = $this->setDataByModel($this->propertyAreaModel, $data, new PropertyArea());
            $propertyArea->setProperty($property);

            $property->setLocation($location);
            $property->setPropertyInside($propertyInside);
            $property->setPropertyOutside($propertyOutside);
            $property->setPropertyOther($propertyOther);
            $property->setPropertyArea($propertyArea);

//            $this->getImagesByProperty($property, $data);

            $this->em->persist($property);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client();
        $res = $client->request('GET', $this->getContainer()->getParameter('export_url'));
        $xml = simplexml_load_string($res->getBody()->getContents(), 'SimpleXMLElement', LIBXML_NOCDATA);
        $arrayData = json_decode(json_encode((array)$xml), true);
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        /** @var array $propertiesIds */
        $propertiesIds = $em->getRepository('AppBundle:Property')->getAffIds();
        $newProperties = [];
        foreach($arrayData['BIEN'] as $item) {
            if (!in_array($item['INFO_GENERALES']['AFF_ID'], $propertiesIds)) {
                $newProperties[] = $item;
            }
        }

        $this->createProperties($newProperties);

        $this->em->flush();
    }
}
