<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="app_front_home")
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param Request $request
     */
    public function indexAction()
    {
        $propertyRepo = $this->getDoctrine()->getRepository('AppBundle:Property');
        $properties = $propertyRepo->findBy([], ['createdAt' => 'DESC'], 9, null);
        return $this->render('front/default/index.html.twig', [
            'properties' => $properties,
        ]);
    }

    /**
     * @Route("/contact", name="app_front_contact")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction()
    {
        return $this->render('front/default/contact.html.twig');
    }

    /**
     * @Route("/about-us", name="app_front_about")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutAction()
    {
        return $this->render(':front/default:about.html.twig');
    }
}
