<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Property;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PropertyController
 * @package AppBundle\Controller\Front
 * @Route("/property")
 */
class PropertyController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/list" , name="app_front_property_list")
     */
    public function listAction()
    {
        return $this->redirectToRoute('app_front_home');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/grid", name="app_front_property_grid")
     */
    public function gridAction()
    {
        return $this->redirectToRoute('app_front_home');
    }

    /**
     * @param Request $request
     * @param Property $property
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/show/{id}", name="app_front_property_show")
     * @ParamConverter("property", class="AppBundle:Property")
     */
    public function showAction(Request $request, Property $property)
    {
        return $this->redirectToRoute('app_front_home');
    }
}
