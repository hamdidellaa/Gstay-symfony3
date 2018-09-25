<?php
/**
 * Created by PhpStorm.
 * User: HD_EXECUTION
 * Date: 05/02/2017
 * Time: 16:36
 */

namespace Gstay\eventBundle\Controller;


use Gstay\eventBundle\Entity\evenement;
use Gstay\eventBundle\Form\evenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;

class eventController extends Controller
{

    /**
     * @Route("/showEvents",name="listeventprofile")
     */
    public function listAction()
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();

        $event = new evenement();
        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user' => $id ));
        $event = $em->getRepository('GstayeventBundle:evenement')->findBy(array('id_organisateur'=>$id));

        //  controle sur le status //
        $error = 0;

        $datenow = new \DateTime('now');
        foreach ($event as $e)
        {
            if($e->getDateDebut() < $datenow || $e->getNbTicket()<1)
            {
                if($e->getStatut()!="inactive")
                {
                    $error++;
                    $e->setStatut('inactive');
                    $em->persist($e);
                    $em->flush();
                }
            }else
            {
                $e->setStatut('actif');
                $em->persist($e);
                $em->flush();
            }

        }


        return $this->render('GstayeventBundle:profile/event:allevent.html.twig',array(
            'event'=>$event,
            'profile'=>$profile,
            'msg'=>"Edit successful",
            'error'=>$error

        ));
    }

    /**
     * @Route("/activ/{id}",name="activevent")
     */
    public function actifEventAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('GstayeventBundle:evenement')->findOneBy(array('id'=>$id));
        if($event->getStatut()=="actif")
        {
            $event->setNbTicket(0);
            $em->persist($event);
            $em->flush();
        }
        else{
            $event->setNbTicket(1);
            $em->persist($event);
            $em->flush();

        }

        return $this->redirectToRoute('listeventprofile');
    }



        /**
     * @Route("/addEvent",name="ajoutevent")
     */
    public function addEventAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();
        $event = new evenement();
        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user' => $id ));
        // $evenement = $em->getRepository('GstayeventBundle:evenement')->findOneBy(array('id_user' => $id ));
        $form = $this->createForm(evenementType::class,$event );
        $form->handleRequest($request);
        if($form->isSubmitted() ) {
            $event->setIdOrganisateur($user);
            $event->setComfirmHotel("en attente");
            $event->setStatut("actif");
            $event->setIdProfile($profile);
            $event->setTicketvendu(0);
            $em->persist($event);
            $em->flush();
             return $this->redirect($this->generateUrl('listeventprofile',array('msg'=>"add successful")));
        }
        return $this->render('GstayeventBundle:profile/event:addevent.html.twig',array(
            'form'=>$form->createView(),
            'profile'=>$profile,

        ));
    }

    /**
     * @Route("/editEvent/{title}",name="editevent")
     */
    public function editEventAction(Request $request,$title)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();

        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user' => $id ));
        $evenement = $em->getRepository('GstayeventBundle:evenement')->findOneBy(array('titre' => $title ));
        $form = $this->createForm(evenementType::class,$evenement );
        $form->handleRequest($request);
        if($form->isSubmitted() ) {
            $em->persist($evenement);
            $em->flush();
              return $this->redirect($this->generateUrl('listeventprofile',array('msg'=>"Edit successful")));
        }
        return $this->render('GstayeventBundle:profile/event:editevent.html.twig',array(
            'form'=>$form->createView(),
            'profile'=>$profile,

        ));

    }

    /**
     * @Route("/deleteEvent/{id}",name="deleteevent")
     */
    public function deleteEventAction($id)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $em=$this->getDoctrine()->getManager();
        $evenement = $em->getRepository('GstayeventBundle:evenement')->findOneBy(array('id' => $id ));
        $em->remove($evenement);
        $em->flush();
        return $this->redirect($this->generateUrl('listeventprofile',array('msg'=>"Delete successful")));

    }

    /**
     * @Route("/detailticket/{id}",name="eventdetailticket")
     */
    public function eventticketAction(Request $request ,$id )
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $idd =  $this->getUser()->getId();


        $em=$this->getDoctrine()->getManager();
        $event = $em->getRepository('GstayeventBundle:evenement')->find($id);
        $ticket = $em->getRepository('GstayeventBundle:ticketevent')->findBy(array('idevent'=>$id));
        $idorganisateur = $event->getIdOrganisateur()->getId();
        if($idorganisateur != $idd)
        {
            return $this->redirectToRoute('profileEvent');
        }
        $organisateur = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user'=>$idorganisateur)   );
        $profile = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user' => $idd ));

        return $this->render('@Gstayevent/profile/event/ticketevent.html.twig',array(
            'event'=>$event,
            'organisateur'=>$organisateur,
            'ticket'=>$ticket,
            'profile'=>$profile

        ));

    }

    ///////////////////////////////////////////////////

    /**
     * @Route("/detail/{id}",name="eventdetail")
     */
    public function testAction(Request $request ,$id )
{
    $event = new evenement();
    $em=$this->getDoctrine()->getManager();
    $event = $em->getRepository('GstayeventBundle:evenement')->find($id);
    $idorganisateur = $event->getIdOrganisateur()->getId();
    $emailorganisateur = $event->getIdOrganisateur()->getEmail();
    $organisateur = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user'=>$idorganisateur)   );

    $csrfToken = $this->has('security.csrf.token_manager')
        ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
        : null;

    return $this->render('GstayeventBundle:pages:eventdetail.html.twig',array(
        'event'=>$event,
        'organisateur'=>$organisateur,
        'emailorganisateur'=>$emailorganisateur,
        'csrf_token' => $csrfToken,
    ));

}

    /**
     * @Route("/Events",name="eventlist")
     */
    public function affichefrontAction(Request $request )
    {
 $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('GstayeventBundle:evenement')->findAll();

        //  controle sur le status //

        $datenow = new \DateTime('now');
        foreach ($event as $e)
        {
            if($e->getDateDebut() < $datenow || $e->getNbTicket()<1)
            {
                if($e->getStatut()!="inactive")
                {
                    $e->setStatut('inactive');
                    $em->persist($e);
                    $em->flush();
                }
            }else
            {
                $e->setStatut('actif');
                $em->persist($e);
                $em->flush();
            }

        }

        if($request->get('title'))
        {
            $dql   = "SELECT a FROM GstayeventBundle:evenement a where a.titre like '%".$request->get('title')."%'";
            $query = $em->createQuery($dql);
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1),
                5
            );
            return $this->render('GstayeventBundle:pages:eventlist.html.twig',array(
                'pagination'=>$pagination,
            ));
            }

        if($request->get('price'))
        {
            $v= $request->get('price');
            $test = explode(',',$v,2);
            $prix1 = $test[0];
            $prix2 = $test[1];

            $dql   = "SELECT a FROM GstayeventBundle:evenement a where a.prix BETWEEN '$prix1' and '$prix2' ";
            $query = $em->createQuery($dql);
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1),
                5
            );

            return $this->render('GstayeventBundle:pages:eventlist.html.twig',array(
                'pagination'=>$pagination,
            ));


        }
        if($request->get('theme') or $request->get('region') )
        {



            $dql   = "SELECT a FROM GstayeventBundle:evenement a WHERE  a.addess like '%".$request->get('region')."%' and a.theme like '%".$request->get('theme')."%'";

            $query = $em->createQuery($dql);

            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1),
                5
            );

            return $this->render('GstayeventBundle:pages:eventlist.html.twig',array(
                'pagination'=>$pagination,
            ));


        }


        $dql   = "SELECT a FROM GstayeventBundle:evenement a ORDER BY a.id DESC";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('GstayeventBundle:pages:eventlist.html.twig',array(
            'pagination'=>$pagination,
        ));

    }


}