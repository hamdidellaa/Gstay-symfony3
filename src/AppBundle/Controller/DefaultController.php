<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Mail;

use AppBundle\Form\MailType;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {


        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM GstayeventBundle:tour a  ORDER BY a.id DESC ";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );

        ///blogs
        $dql2   = "SELECT a FROM GstayforumBundle:Blog a  ORDER BY a.id_Blog DESC ";
        $query2 = $em->createQuery($dql2);

        $paginator2  = $this->get('knp_paginator');
        $pagination2 = $paginator2->paginate(
            $query2,
            $request->query->getInt('page', 1),
            5
        );
        ////bloglekherSELECT * FROM blog ORDER BY id_Blog DESC LIMIT 1



        $dql3   = "SELECT a FROM GstayforumBundle:Blog a ORDER BY a.id_Blog DESC ";

        $query3 = $em->createQuery($dql3);
        $query3->setMaxResults(1);
        $paginator3  = $this->get('knp_paginator');
        $pagination3 = $paginator3->paginate(
            $query3,
            $request->query->getInt('page', 1),
            1
        );
        $paginator4  = $this->get('knp_paginator');
        $pagination4 = $paginator4->paginate(
            $query3,
            $request->query->getInt('page', 2),
            3
        );

        $Hotel=$em->getRepository("GstayhotelBundle:Hotel")->findBy(array('country' => 'Tunisia'), array('stars' => 'DESC'));
        $africa = array('Tunisia','Algeria','Morocco','Lybia','Egypt');
        $queryafrica = $em->createQuery('SELECT h FROM GstayhotelBundle:Hotel h WHERE h.country IN (:africa)');
        $queryafrica->setParameters(array(
            'africa' => $africa,



        ));
        $africashow = $queryafrica->getResult();
//europe
        $europe = array('France','Great Britain','Germany','Italy','Spain','Portugal','Belgium','Netherlands','Greece','Turkey');
        $queryeurope = $em->createQuery('SELECT h FROM GstayhotelBundle:Hotel h WHERE h.country IN (:europe)');
        $queryeurope->setParameters(array(
            'europe' => $europe,



        ));
        $europeshow = $queryeurope->getResult();
        //asia
        $asia = array('China','Japan','Indonesia','Malaysia','Thailand','Singapore','Cambodia','Vietnam','Nepal','India','Taiwan','South Korea','United Arab Emirates');
        $queryasia = $em->createQuery('SELECT h FROM GstayhotelBundle:Hotel h WHERE h.country IN (:asia)');
        $queryasia->setParameters(array(
            'asia' => $asia,



        ));
        $asiashow = $queryasia->getResult();
        //america
        $america = array('United States of America','Canada','Mexico','Brazil','Argentina','Uruguay','Bahamas','Panama','Cuba');
        $queryamerica = $em->createQuery('SELECT h FROM GstayhotelBundle:Hotel h WHERE h.country IN (:america)');
        $queryamerica->setParameters(array(
            'america' => $america,



        ));
        $americashow = $queryamerica->getResult();
        //australia
        $australia = array('Australia','New Zealand','Fiji','Samoa','Guam','American Samoa');
        $queryaustralia = $em->createQuery('SELECT h FROM GstayhotelBundle:Hotel h WHERE h.country IN (:australia)');
        $queryaustralia->setParameters(array(
            'australia' => $australia,



        ));
        $australiashow = $queryaustralia->getResult();




        return $this->render('default/index.html.twig',array(
            'tour'=>$pagination,'blog'=>$pagination2,'lastblog'=>$pagination3,'zouz'=>$pagination4,"Hotelafrica"=>$africashow , "Hoteleurope"=>$europeshow,"Hotelasia"=>$asiashow,"Hotelamerica"=>$americashow,"Hotelaustralia"=>$australiashow,


        ));

    }


    /**
     * @Route("/email", name="email")
     */
    public function afficheAction(Request $request)
    {
        $mail = new Mail();
        $form= $this->createForm(MailType::class, $mail);
        $form->handleRequest($request) ;
        if ($form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Accusé de réception')
                ->setFrom('espritplus2016@gmail.com')
                ->setTo($mail->getEmail())
                ->setBody(
                    $this->renderView(
                        'email.html.twig',
                        array('nom' => $mail->getNom(), 'prenom'=>$mail->getPrenom())
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
            return $this->redirect($this->generateUrl('emailsuccses'));

        }
        return $this->render('index.html.twig', array('form'=>$form
            ->createView()));
    }

    /**
     * @Route("/emailsuccses", name="emailsuccses")
     */
    public function successAction(){
        return new Response("email envoyé avec succès, Merci de vérifier votre adresse mail
.");
    }

}
