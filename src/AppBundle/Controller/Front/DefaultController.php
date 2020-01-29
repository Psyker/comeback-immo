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
            $to = $this->getParameter('mailer_user');
            $body = $this->render(':front/mail:contact_mail.html.twig', [
                'message' => $form->getData()['message'],
                'name' => $form->getData()['name'],
                'email' => $form->getData()['email'],
                'subject' => $form->getData()['subject'],
                'phone' => $form->getData()['phone']
            ]);
            $headers = [];
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';
            $headers[] = 'To: Mary <'. $to .'@example.com>, '. $to .' <'. $to .'>';
            $headers[] = 'From: '.$to.' <'. $to .'>';
            mail(
                $to,
                'Vous avez un nouveau message ! | Comeback-Immobilier',
                $body->getContent(),
                implode("\r\n", $headers)
            );

            $this->addFlash('success', 'Votre message a bien été envoyé');
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
