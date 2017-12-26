<?php

namespace AppBundle\Controller\Front;

use AppBundle\Form\ContactForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(ContactForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message = new \Swift_Message();
            $message->setBody($form->getData()['message']);
            $message->setSubject($form->getData()['subject']);
            $message->setFrom($form->getData()['email']);
            $message->setTo('bourgoi.theo@gmail.com');

            $this->addFlash('succes', 'Votre message a bien été envoyé');

            $this->get('swiftmailer.mailer')->send($message);
        }
        return $this->render('front/default/contact.html.twig', [
            'form' => $form->createView()
        ]);
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
