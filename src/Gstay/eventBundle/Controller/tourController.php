<?php
/**
 * Created by PhpStorm.
 * User: HD_EXECUTION
 * Date: 05/02/2017
 * Time: 16:36
 */

namespace Gstay\eventBundle\Controller;


use Gstay\eventBundle\Entity\evenement;

use Gstay\eventBundle\Entity\tour;
use Gstay\eventBundle\Form\tourType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class tourController extends Controller
{


    /**
     * @Route("/showTours",name="listtourprofile")
     */
    public function listAction()
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();
        $newid = uniqid();
        $tour = new evenement();
        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user' => $id ));
        $tour = $em->getRepository('GstayeventBundle:tour')->findBy(array('id_organisateur'=>$id));

        //  controle sur le status //
        $error = 0;
        $datenow = new \DateTime('now');
        foreach ($tour as $t)
        {
            if($t->getDatedebut() < $datenow || $t->getMaxplace()<1)
            {
                if($t->getStatut()!="inactive")
                {
                    $error++;
                    $t->setStatut('inactive');
                    $em->persist($t);
                    $em->flush();
                }

            }else
            {
                $t->setStatut('actif');
                $em->persist($t);
                $em->flush();
            }

        }



        return $this->render('GstayeventBundle:profile/tour:alltour.html.twig',array(
            'tour'=>$tour,
            'profile'=>$profile,
            'msg'=>"Edit successful",
            'newid'=>$newid,
            'error'=>$error




        ));

    }

    /**
     * @Route("/activtour/{id}",name="activtour")
     */
    public function actifEventAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $tour = $em->getRepository('GstayeventBundle:tour')->findOneBy(array('id'=>$id));
        if($tour->getStatut()=="actif")
        {
            $tour->setMaxplace(0);
            $em->persist($tour);
            $em->flush();
        }
        else{
            $tour->setMaxplace(1);
            $em->persist($tour);
            $em->flush();

        }





        return $this->redirectToRoute('listtourprofile');
    }




    /**
     * @Route("/addTour",name="ajouttour")
     */
    public function addEventAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();

        $tour = new tour();
        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user' => $id ));
        $form = $this->createForm(tourType::class,$tour );
        $form->handleRequest($request);

        if($form->isSubmitted() ) {

            $tour->setIdOrganisateur($user);
            $tour->setStatut("actif");
            $tour->setTicketvendu(0);
            $em->persist($tour);
            $em->flush();
            return $this->redirect($this->generateUrl('listtourprofile',array('msg'=>"add successful")));
        }
        return $this->render('GstayeventBundle:profile/tour:addTour.html.twig',array(
            'form'=>$form->createView(),
            'profile'=>$profile,

        ));


    }


    /**
     * @Route("/editTour/{idd}",name="edittour")
     */
    public function editEventAction(Request $request,$idd)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();

        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user' => $id ));
        $tour = $em->getRepository('GstayeventBundle:tour')->findOneBy(array('id' => $idd ));
        $form = $this->createForm(tourType::class,$tour );
        $form->handleRequest($request);
        if($form->isSubmitted() ) {
            $em->persist($tour);
            $em->flush();
            return $this->redirect($this->generateUrl('listtourprofile',array('msg'=>"Edit successful")));
        }
        return $this->render('GstayeventBundle:profile/tour:editTour.html.twig',array(
            'form'=>$form->createView(),
            'profile'=>$profile,
            'idd'=>$idd



        ));




    }

    /**
     * @Route("/deletetour/{id}",name="deletetour")
     */
    public function deleteEventAction($id)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }


        $em=$this->getDoctrine()->getManager();
        $tour = $em->getRepository('GstayeventBundle:tour')->findOneBy(array('id' => $id ));
        $em->remove($tour);
        $em->flush();
        return $this->redirect($this->generateUrl('listtourprofile',array('msg'=>"Delete successful")));


    }





    /**
     * @Route("/tourdetailticket/{id}",name="tourdetailticket")
     */
    public function eventticketAction(Request $request ,$id )
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $idd =  $this->getUser()->getId();


        $tour = new tour();
        $em=$this->getDoctrine()->getManager();
        $tour = $em->getRepository('GstayeventBundle:tour')->find($id);
        $ticket = $em->getRepository('GstayeventBundle:ticketevent')->findBy(array('idtour'=>$id));
        $idorganisateur = $tour->getIdOrganisateur()->getId();

        if($idorganisateur != $idd)
        {
            return $this->redirectToRoute('profileEvent');
        }

        $organisateur = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user'=>$idorganisateur)   );
        $profile = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user' => $idd ));


        return $this->render('@Gstayevent/profile/tour/tickettour.html.twig',array(
            'tour'=>$tour,
            'organisateur'=>$organisateur,
            'ticket'=>$ticket,
            'profile'=>$profile

        ));





    }

    /////////////////////////////////////////////////////

    /**
     * @Route("/ToursView",name="tourslistGrid")
     */
    public function affichefrontgridAction(Request $request )
    {
        $em=$this->getDoctrine()->getManager();
        $tour = $em->getRepository('GstayeventBundle:tour')->findAll();
        $datenow = new \DateTime('now');
        foreach ($tour as $t)
        {
            if($t->getDatedebut() < $datenow || $t->getMaxplace()<1)
            {
                if($t->getStatut()!="inactive")
                {
                    $t->setStatut('inactive');
                    $em->persist($t);
                    $em->flush();
                }
            }else
            {
                $t->setStatut('actif');
                $em->persist($t);
                $em->flush();
            }
        }
        if( $request->get('region') )
        {
 $dql   = "SELECT t FROM GstayeventBundle:tour t INNER JOIN GstayeventBundle:days d where t.id = d.id_tour and d.address like '%".$request->get('region')."%'";
            $query = $em->createQuery($dql);
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1),
                5
            );
            return $this->render('GstayeventBundle:pages:tourgrid.html.twig',array(
                'tour'=>$pagination,
            ));

        }
        $dql   = "SELECT a FROM GstayeventBundle:tour a ORDER BY a.id DESC";
        $query = $em->createQuery($dql);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('GstayeventBundle:pages:tourgrid.html.twig',array(
            'tour'=>$pagination,
        ));

    }


    /**
     * @Route("/Tours",name="tourslist")
     */
    public function affichefrontAction(Request $request )
    {

        $em=$this->getDoctrine()->getManager();
        $tour = $em->getRepository('GstayeventBundle:tour')->findAll();
        $datenow = new \DateTime('now');
        foreach ($tour as $t)
        {
            if($t->getDatedebut() < $datenow || $t->getMaxplace()<1)
            {
                if($t->getStatut()!="inactive")
                {
                    $t->setStatut('inactive');
                    $em->persist($t);
                    $em->flush();
                }
            }else
            {
                $t->setStatut('actif');
                $em->persist($t);
                $em->flush();
            }
        }
        if($request->get('title'))
        {
            $dql   = "SELECT a FROM GstayeventBundle:tour a where a.title like '%".$request->get('title')."%'";
            $query = $em->createQuery($dql);
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1),
                5
            );
            return $this->render('GstayeventBundle:pages:tourlist.html.twig',array(
                'tour'=>$pagination,
            ));
        }
        if( $request->get('region') )
        {
            $dql   = "SELECT t FROM GstayeventBundle:tour t INNER JOIN GstayeventBundle:days d where t.id = d.id_tour and d.address like '%".$request->get('region')."%'";
            $query = $em->createQuery($dql);

            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1),
                5
            );
            return $this->render('GstayeventBundle:pages:tourlist.html.twig',array(
                'tour'=>$pagination,
            ));

        }

        if($request->get('price'))
        {
            $v= $request->get('price');
            $test = explode(',',$v,2);
            $prix1 = $test[0];
            $prix2 = $test[1];
            if($prix2 == 1500)
            {
                $prix2=5000;
            }
            $dql   = "SELECT a FROM GstayeventBundle:tour a where a.prix BETWEEN '$prix1' and '$prix2' ";
            $query = $em->createQuery($dql);
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1),
                5
            );

            return $this->render('GstayeventBundle:pages:tourlist.html.twig',array(
                'tour'=>$pagination,
            ));
        }

        $dql   = "SELECT a FROM GstayeventBundle:tour a  ORDER BY a.id DESC ";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('GstayeventBundle:pages:tourlist.html.twig',array(
            'tour'=>$pagination,

        ));

    }


    /**
     * @Route("/detailtour/{id}",name="tourdetail")
     */
    public function testAction(Request $request ,$id )
    {

        $csrfToken = $this->has('security.csrf.token_manager')
            ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
            : null;

        $tour = new tour();
        $em=$this->getDoctrine()->getManager();
        $tour = $em->getRepository('GstayeventBundle:tour')->findOneBy(array('id'=>$id));
        $days = $em->getRepository('GstayeventBundle:days')->findBy(array('id_tour'=> $id));
        return $this->render('GstayeventBundle:pages:tourdetail.html.twig',array(
            'tour'=>$tour,
            'days'=>$days,
            'csrf_token' => $csrfToken,

        ));




    }

}