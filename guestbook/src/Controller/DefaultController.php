<?php

namespace Serge\GuestbookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $form = $this->createFormBuilder()
            ->add('name', 'text')
            ->add('email', 'email')
            ->add('text', 'textarea')
			->add('file')
            ->getForm();

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('GuestbookBundle:Entry');

        $aEntry = $repo->findBy(array(), array("id" => "DESC"), 10);
        return $this->render('GuestbookBundle:Default:index.html.twig', array(
            'aEntry' => $aEntry,
            'form' => $form->createView(),
        ));
    }
}
