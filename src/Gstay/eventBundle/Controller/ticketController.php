<?php
/**
 * Created by PhpStorm.
 * User: HD_EXECUTION
 * Date: 05/02/2017
 * Time: 16:36
 */

namespace Gstay\eventBundle\Controller;


use Gstay\eventBundle\Entity\evenement;

use Gstay\eventBundle\Entity\message;
use Gstay\eventBundle\Entity\ticketevent;
use Gstay\eventBundle\Entity\tour;
use Gstay\eventBundle\Form\tourType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;


class ticketController extends Controller
{


    /**
     * @Route("/ticket_event",name="ticket_evenement")
     */
    public function eventAction(Request $request)
    {

        $ticket = new ticketevent();
        $em=$this->getDoctrine()->getManager();

        $event = $em->getRepository('GstayeventBundle:evenement')->findOneBy(array('id'=>$request->get('idevent')));
        $user = $em->getRepository('AppBundle:User')->findOneBy(array('id'=>$request->get('iduser')));

        $ticket1 = $em->getRepository('GstayeventBundle:ticketevent')
            ->findOneBy(array('idevent'=>$event , 'iduser'=>$user ));

        if($ticket1)
        {
            return new Response("non");
        }

        $refticket = uniqid('Gstay');
        if($request->isMethod('POST'))
        {
            $ticket->setNbticket($request->get('nbticket'));
            $ticket->setIduser($user);
            $ticket->setIdevent($event);
            $ticket->setRefticket($refticket);
            $ticket->setDate(new \DateTime('now'));

            $em->persist($ticket);
            $em->flush();

            $event->setNbTicket($event->getNbTicket()- $request->get('nbticket'));
            $event->setTicketvendu($event->getTicketvendu() + $request->get('nbticket'));
            $em->persist($event);
            $em->flush();

            return new Response($refticket);
        }


        return new Response("bonjour");

    }

    /**
     * @Route("/ticket_tour",name="ticket_tour")
     */
    public function tourAction(Request $request)
    {
        $ticket = new ticketevent();
        $em=$this->getDoctrine()->getManager();
        $tour = $em->getRepository('GstayeventBundle:tour')->findOneBy(array('id'=>$request->get('idtour')));
        $user = $em->getRepository('AppBundle:User')->findOneBy(array('id'=>$request->get('iduser')));
        $ticket1 = $em->getRepository('GstayeventBundle:ticketevent')
            ->findOneBy(array('idtour'=>$tour , 'iduser'=>$user ));
        if($ticket1)
        {
            return new Response("non");
        }
        $refticket = uniqid('Gstay');
        if($request->isMethod('POST'))
        {
            $ticket->setNbticket($request->get('nbticket'));
            $ticket->setIduser($user);
            $ticket->setIdtour($tour);
            $ticket->setRefticket($refticket);
            $ticket->setDate(new \DateTime('now'));
            $em->persist($ticket);
            $em->flush();
            $tour->setMaxplace($tour->getMaxplace() - $request->get('nbticket'));
            $tour->setTicketvendu($tour->getTicketvendu() + $request->get('nbticket'));
            $em->persist($tour);
            $em->flush();

            return new Response($refticket);


        }

        return new Response("bonjour");

    }



    /**
     * @Route("/ticket_pdf/",name="ticket_pdf")
     */
    public function pdfAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $ref=$request->get('ref');
        $ticket = $em->getRepository('GstayeventBundle:ticketevent')
            ->findOneBy(array('refticket'=>$ref ));
        $profile = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user'=> $ticket->getIduser()));
         $tour = $em->getRepository('GstayeventBundle:tour')->findOneBy(array('id'=> $ticket->getIdtour()));
$date1 = date_format($tour->getDatedebut(), 'Y-m-d ');
$date2 = date_format(new \DateTime('now'), 'Y-m-d ');
        $snappy = $this->get('knp_snappy.pdf');

       $image = 'namous.jpg';
        if($profile->getImageName()!="")
        {
            $image = $profile->getImageName();
        }

        $html = '<h1 style="text-align: center;"><strong>** Gstay Event **</strong></h1>
<p>&nbsp;</p>
<h3 style="text-align: center;"><strong>Tour : '. $tour->getTitle() .' &nbsp;</strong></h3>
<h3 style="text-align: center;"><strong>Ticket : '. $ref .'</strong></h3>
<p style="text-align: center;">&nbsp;<strong><img src="http://localhost/pidevGsay/web/images/products/'.$image.'" alt="" width="152" height="152" /></strong></p>
<h3 style="text-align: center;">&nbsp;'.$profile->getNom().'  '.$profile->getPrenom().'</h3>
<h3 style="text-align: center;">&nbsp;'.$date1.'</h3>
<h3 style="padding-left: 70px;">&nbsp;</h3>
<p>&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">&nbsp; this ticket was generated by GstayEvent</p>
<p style="text-align: center;">&nbsp; '.$date2.'</p>
<p>&nbsp;</p>
<p style="padding-left: 480px;">&nbsp;</p>
<p style="padding-left: 450px;">&nbsp;</p>
<p style="padding-left: 360px;">&nbsp;</p>
<p style="padding-left: 60px;">&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>';

        if( !$request->get('email'))
        {
            $message = \Swift_Message::newInstance()
                ->setSubject('Ticket Gstay')
                ->setFrom('hamdi.dellaa@esprit.tn')
                ->setTo($profile->getIdUser()->getemail())
                ->setBody(
                    $this->renderView(
                        'email.html.twig',
                        array('nom' => $profile->getNom(), 'prenom'=>$profile->getPrenom() ,
                            'link'=>'http://localhost/pidevGsay/web/app_dev.php/event/ticket_pdf/?ref='.$ref.'&email=1')
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
        }

        $filename = 'Ticket';
        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="'.$filename.'.pdf"'
            )
        );

    }



    /**
     * @Route("/event_pdf/",name="event_pdf")
     */
    public function pdf1Action(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $ref=$request->get('ref');
        $ticket = $em->getRepository('GstayeventBundle:ticketevent')->findOneBy(array('refticket'=>$ref ));
        $profile = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user'=> $ticket->getIduser()));
        $event = $em->getRepository('GstayeventBundle:evenement')->findOneBy(array('id'=> $ticket->getIdevent()));
$date1 = date_format($event->getDateDebut(), 'Y-m-d ');
        $date2 = date_format(new \DateTime('now'), 'Y-m-d ');


        $image = 'namous.jpg';
        if($profile->getImageName()!="")
        {
            $image = $profile->getImageName();
        }

        $snappy = $this->get('knp_snappy.pdf');
        $html = '<h1 style="text-align: center;"><strong>** Gstay Event **</strong></h1>
<p>&nbsp;</p>
<h3 style="text-align: center;"><strong>Event : '. $event->getTitre() .' &nbsp;</strong></h3>
<h3 style="text-align: center;"><strong>Ticket : '. $ref .'</strong></h3>
<p style="text-align: center;">&nbsp;<strong><img src="http://localhost/pidevGsay/web/images/products/'.$image.'" alt="" width="152" height="152" /></strong></p>
<h3 style="text-align: center;">&nbsp;'.$profile->getNom().'  '.$profile->getPrenom().'</h3>
<h3 style="text-align: center;">&nbsp;'.$date1.'</h3>
<h3 style="padding-left: 70px;">&nbsp;</h3>
<p>&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">&nbsp; this ticket was generated by GstayEvent</p>
<p style="text-align: center;">&nbsp; '.$date2.'</p>
<p>&nbsp;</p>
<p style="padding-left: 480px;">&nbsp;</p>
<p style="padding-left: 450px;">&nbsp;</p>
<p style="padding-left: 360px;">&nbsp;</p>
<p style="padding-left: 60px;">&nbsp;</p>
<p style="text-align: center;">&nbsp;</p>';


        $filename = 'Ticket';
        if( !$request->get('email'))
        {
            $message = \Swift_Message::newInstance()
                ->setSubject('Ticket Gstay')
                ->setFrom('hamdi.dellaa@esprit.tn')
                ->setTo($profile->getIdUser()->getemail())
                ->setBody(
                    $this->renderView(
                        'email.html.twig',
                        array('nom' => $profile->getNom(), 'prenom'=>$profile->getPrenom() ,
                            'link'=>'http://localhost/pidevGsay/web/app_dev.php/event/event_pdf/?ref='.$ref.'&email=1')
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
        }


        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="'.$filename.'.pdf"'
            )
        );

    }



}