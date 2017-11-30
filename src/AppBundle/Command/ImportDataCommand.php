<?php

namespace AppBundle\Command;

use AppBundle\Entity\Interfaces\PropertyInterface;
use AppBundle\Entity\Location;
use AppBundle\Entity\Property;
use AppBundle\Entity\PropertyInside;
use AppBundle\Entity\PropertyOther;
use AppBundle\Entity\PropertyOutside;
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
            'DATE_MAJ' => 'setUpdatedAt'
        ]
    ];

    private $locationModel = [
        'LOCALISATION' => [
            'CODE_POSTAL' => 'setZipCode',
            'VILLE' => 'setCity',
            'PAYS' => 'setCountry',
            'PROXIMITE' => [
                'COMMERCES' => 'setShopProximity',
                'BUS' => 'setBusProximity'
            ]
        ],
        'APPARTEMENT' => [
            'NUM_ETAGE' => 'setFloorQuantity'
        ]
    ];

    private $propertyInsideModel = [
        'MAISON' => [
            'NBRE_PIECES' => 'setRoomQuantity',
            'NBRE_CHAMBRES' => 'setBedroomQuantity',
            'NBRE_SALLE_BAIN' => 'setBathroomQuantity',
            'NBRE_SALLE_EAU' => 'setWashroomQuantity',
            'NBRE_WC' => 'setToiletQuantity',
            'CUISINE' => 'setKitchen',
            'MODE_CHAUFFAGE' => 'setHeatingType'
        ],
        'APPARTEMENT' => [
            'NBRE_PIECES' => 'setRoomQuantity',
            'NBRE_CHAMBRES' => 'setBedroomQuantity',
            'NBRE_SALLE_BAIN' => 'setBathroomQuantity',
            'NBRE_SALLE_EAU' => 'setWashroomQuantity',
            'NBRE_WC' => 'setToiletQuantity',
            'CUISINE' => 'setKitchen',
            'MODE_CHAUFFAGE' => 'setHeatingType'
        ]
    ];

    private $propertyOutsideModel = [
        'MAISON' => [
            'JARDIN' => 'setGarden',
            'ANNEE_CONSTRUCTION' => 'setYearOfConstruction'
        ],
        'APPARTEMENT' => [
            'JARDIN' => 'setGarden',
            'ANNEE_CONSTRUCTION' => 'setYearOfConstruction'
        ]
    ];

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


        foreach ($arrayData['BIEN'] as $data) {
            /** @var Property $property */
            $property = $this->setDataByModel($this->propertyModel, $data, new Property());
            if (array_key_exists('MAISON', $data)) {
                $property->setType(Property::PROPERTY_HOUSE);
            } else {
                $property->setType(Property::PROPERTY_APARTMENT);
            }

            /** @var Location $location */
            $location = $this->setDataByModel($this->locationModel, $data, new Location());

            /** @var PropertyInside $propertyInside */
            $propertyInside = $this->setDataByModel($this->propertyInsideModel, $data, new PropertyInside());

            /** @var PropertyOutside $propertyOutside */
            $propertyOutside = $this->setDataByModel($this->propertyOutsideModel, $data, new PropertyOutside());

            $propertyOther = $this->setDataByModel($this->propertyOtherModel, $data, new PropertyOther());

            $property->setLocation($location);
            $property->setPropertyInside($propertyInside);
            $property->setPropertyOutside($propertyOutside);

            dump($property);

        }



//        /** @var array $data */
//        foreach ($arrayData['BIEN'] as $data) {
//            $propertyType = null;
//            if (array_key_exists('MAISON', $data)) {
//                $propertyType = Property::PROPERTY_HOUSE;
//            } elseif (array_key_exists('APPARTEMENT', $data)) {
//                $propertyType = Property::PROPERTY_APARTMENT;
//            }
//
//            $dataLocation = $data['LOCALISATION'];
//
//            $location = (new Location())
//                ->setZipCode($dataLocation['CODE_POSTAL'])
//                ->setCity($dataLocation['VILLE'])
//                ->setCountry($dataLocation['PAYS'])
//                ->setShopProximity($dataLocation['PROXIMITE']['COMMERCES'])
//                ->setBusProximity($dataLocation['PROXIMITE']['BUS']);
//
//            if ($propertyType === Property::PROPERTY_HOUSE) {
//                $location->setFloorQuantity($data['MAISON']['NUM_ETAGE']);
//            } elseif ($propertyType === Property::PROPERTY_APARTMENT) {
//                $location->setFloorQuantity($data['APPARTEMENT']['NUM_ETAGE']);
//            }
//
//            $dataInside = $data['MAISON'];
//
//            $propertyInside = (new PropertyInside())
//                ->setRoomQuantity($dataInside['NBRE_PIECES'])
//                ->setBedroomQuantity($dataInside['NBRE_CHAMBRES'])
//                ->setBathroomQuantity($dataInside['NBRE_SALLE_BAIN'])
//                ->setWashroomQuantity($dataInside['NBRE_SALLE_EAU'])
//                ->setToiletQuantity($dataInside['NBRE_WC'])
//                ->setKitchen($dataInside['CUISINE'])
//                ->setHeatingType($dataInside['MODE_CHAUFFAGE']);
//
//            $propertyOutside = (new PropertyOutside())
//                ->setGarden($data['MAISON']['JARDIN'])
//                ->setYearOfConstruction($data['MAISON']['ANNEE_CONSTRUCTION']);
//
//            $dataGeneral = $data['INFOS_GENERALES'];
//
//            $property = (new Property())
//                ->setType($propertyType)
//                ->setAffId($dataGeneral['AFF_ID'])
//                ->setLocation($location)
//                ->setPropertyInside($propertyInside)
//                ->setPropertyOutside($propertyOutside)
//                ->setCreatedAt($dataGeneral['DATE_CREATION'])
//                ->setUpdatedAt($dataGeneral['DATE_MAJ']);
//
//
//            $propertyOther = new PropertyOther();
//            if ($propertyType === Property::PROPERTY_APARTMENT) {
//                $propertyOther->setElevator($data['APPARTEMENT']['ASCENSEUR'])
//                    ->setDigicode($data['APPARTEMENT']['DIGICODE'])
//                    ->setIntercom($data['APPARTEMENT']['INTERPHONE'])
//                    ->setBasement($data['APPARTEMENT']['SOUS_SOL'])
//                    ->setGarageQuantity($data['APPARTEMENT']['NBRE_GARAGE']);
//            } elseif ($propertyType === Property::PROPERTY_HOUSE) {
//                $propertyOther->setElevator($data['MAISON']['ASCENSEUR'])
//                    ->setBasement($data['MAISON']['SOUS_SOL'])
//                    ->setGarageQuantity($data['MAISON']['NBRE_GARAGE']);
//            }
//
//        }

    }
}
