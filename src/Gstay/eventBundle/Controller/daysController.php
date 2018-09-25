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


        return new Response("bonjour");

    }


}