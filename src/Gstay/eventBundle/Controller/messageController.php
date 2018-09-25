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
use Gstay\eventBundle\Entity\tour;
use Gstay\eventBundle\Form\tourType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class messageController extends Controller
{



    /**
     * @Route("/message",name="message_evenement")
     */
    public function listAction(Request $request)
    {

        $msg = new message() ;
        $em=$this->getDoctrine()->getManager();
        $event = $em->getRepository('GstayeventBundle:evenement')->findOneBy(array('id'=>$request->get('ideventuser')));
        $user = $em->getRepository('AppBundle:User')->findOneBy(array('id'=>$request->get('iduser')));
$userreciv = $em->getRepository('AppBundle:User')->findOneBy(array('id'=>$request->get('organisateur')));
           if($request->isMethod('POST'))
           {
               $msg->setMessage($request->get('messageuser'));
               $msg->setIduser($user);
               $msg->setIdevent($event);
               $msg->setIdreciver($userreciv);
               $msg->setDate(new \DateTime('now'));

               $em->persist($msg);
               $em->flush();
               return new Response("ajoutage avec success");
           }


        return new Response("bonjour");

    }

    /**
     * @Route("/myMessages",name="message_profile")
     */
    public function mesgAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();

        $em=$this->getDoctrine()->getManager();

       // $message = $em->getRepository('GstayeventBundle:message')->findBy(array('idreciver'=>$id));

        $dql   = "SELECT a FROM GstayeventBundle:message a where a.idreciver=".$id." order by a.id DESC ";
        $query = $em->createQuery($dql);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            4
        );
        $profile = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user' => $id ));


        return $this->render('GstayeventBundle:profile:myMessage.html.twig',array(
            'msg'=>$pagination,
            'profile'=>$profile

        ));


    }
    /**
     * @Route("/myMegdelete/{id}",name="message_delete")
     */
    public function mesgdeleteAction(Request $request , $id)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }

        $em=$this->getDoctrine()->getManager();
        $message = $em->getRepository('GstayeventBundle:message')->findOneBy(array('id'=>$id));
$message->setLu('lu');
        $em->persist($message);
        $em->flush();
        return $this->redirectToRoute('message_profile');

    }

    /**
     * @Route("/myMsgreadall/",name="message_readAll")
     */
    public function readallAction(Request $request )
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }

        $em=$this->getDoctrine()->getManager();
        $message = $em->getRepository('GstayeventBundle:message')->findBy(array('lu'=>"nonlu"));
        foreach ( $message as $m)
        {
            $m->setLu('lu');
            $em->persist($m);
            $em->flush();
        }

        return $this->redirectToRoute('message_profile');

    }



}