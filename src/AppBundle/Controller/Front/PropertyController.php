<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Property;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class PropertyController
 * @package AppBundle\Controller\Front
 * @Route("/property")
 * @Method("GET")
 */
class PropertyController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/list", name="app_front_property_list")
     */
    public function listAction(Request $request)
    {
        $page = $request->get('page', 1);
        $properties = $this->getDoctrine()->getRepository('AppBundle:Property')->getPropertiesPaginated(5, $page);
        return $this->render('front/property/display/list.html.twig', [
            'properties' => $properties
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/grid", name="app_front_property_grid")
     */
    public function gridAction(Request $request)
    {
        $page = $request->get('page', 1);
        $properties = $this->getDoctrine()->getRepository('AppBundle:Property')->getPropertiesPaginated(8, $page);
        return $this->render('front/property/display/grid.html.twig', [
            'properties' => $properties
        ]);
    }

    /**
     * @param Property $property
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param Request $request
     * @Route("/show/{id}", name="app_front_property_show")
     * @ParamConverter("property", class="AppBundle:Property")
     */
    public function showAction(Property $property)
    {
        $relatedProperties = $this->getDoctrine()->getRepository('AppBundle:Property')->getRelatedProperties($property);
        return $this->render('front/property/show.html.twig', [
            'property' => $property,
            'relatedProperties' => $relatedProperties
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/search", name="app_front_search")
     * @Method("GET")
     */
    public function searchAction(Request $request)
    {
        $page = $request->get('page', 1);
        if (!empty($request->query->all())) {
            $properties = $this->getDoctrine()->getRepository('AppBundle:Property')
                ->searchProperties($request->query, $page);

            return $this->render('front/property/results.html.twig', [
                'properties' => $properties
            ]);
        }

        $this->addFlash('danger', 'Une erreur est survenue. Réessayer plus tard.');
        return $this->redirectToRoute('app_front_home');
    }
}
