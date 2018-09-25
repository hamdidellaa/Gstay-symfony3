<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 06/02/2017
 * Time: 22:14
 */

namespace Gstay\guesthostBundle\Controller;



use Gstay\eventBundle\Entity\profile;
use Gstay\guesthostBundle\Form\EquipementType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Gstay\guesthostBundle\Entity\LogementPortfolio;
use Gstay\guesthostBundle\Entity\Logement;
use Gstay\guesthostBundle\Entity\hostguest;
use Symfony\Component\HttpFoundation\Request;
use Gstay\guesthostBundle\Entity\Equipement;
use Gstay\guesthostBundle\Form\LogementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class LogementController extends Controller
{
    /**
 * @Route("/listlogement",name="listlogement")
 */
    public function listLogementAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();


        $logements=$em->getRepository('GstayguesthostBundle:Logement')->findAll();
        $paginator  = $this->get('knp_paginator');

        $result= $pagination = $paginator->paginate(
            $logements, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 6)
        );


        return $this->render('GstayguesthostBundle:Logement:listlogement.html.twig',
            array('logements'=>$result));

    }


    /**
     * @Route("/logementDetail/{idlogement}",name="logementDetail")
     */
    public function logementDetailAction($idlogement)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();

        $em=$this->getDoctrine()->getManager();

        $profile = $em->getRepository('GstayguesthostBundle:hostguest')->findOneBy(array('id_user' => $id ));

        $logements = $em->getRepository('GstayguesthostBundle:Logement')->findOneBy(array('idlogement' => $idlogement ));
        $portfolio = $em->getRepository('GstayguesthostBundle:LogementPortfolio')->findBy(array('id_user' => $idlogement ));

        $equip = $em->getRepository('GstayguesthostBundle:Equipement')->findBy(array('idequiplogement' =>$idlogement  ));
        return $this->render('GstayguesthostBundle:Logement:logementdetails.html.twig',array("logements"=>$logements,
            "equi"=>$equip,"portfolio"=>$portfolio,'profile'=>$profile));

    }

    /**
     * @Route("/deleteLogement/{id}",name="deleteLogement")
     */
    public function deleteLogementAction($id)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }



        $em=$this->getDoctrine()->getManager();
        $Logement = $em->getRepository('GstayguesthostBundle:Logement')->findOneBy(array('idlogement' => $id ));

        $em->remove($Logement);
        $em->flush();

        return $this->redirect($this->generateUrl('meslogements',array('msg'=>"Delete successful")));





    }
    /**
     * @Route("/deleteEquipement/{id}",name="deleteEquipement")
     */
    public function deleteEquipementAction($id)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }



        $em=$this->getDoctrine()->getManager();

        $equip = $em->getRepository('GstayguesthostBundle:Equipement')->findOneBy(array('idequipement' => $id ));



            $em->remove($equip);
        $em->flush();
        return $this->redirectToRoute('editLogement',array('idlogement'=>1));






    }
    /**
     * @Route("/editLogement/{idlogement}",name="editLogement")
     */
    public function editLogementAction(Request $request,$idlogement)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();


        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayguesthostBundle:hostguest')->findOneBy(array('id_user' => $id ));

        $equipement=new Equipement();

        $Logement = $em->getRepository('GstayguesthostBundle:Logement')->findOneBy(array('idlogement' => $idlogement));
        $equip = $em->getRepository('GstayguesthostBundle:Equipement')->findBy(array('idequiplogement' => $Logement ));
        $form = $this->createForm(LogementType::class,$Logement );
        $fForm = $this->createForm(EquipementType::class,$equipement );

        $form->handleRequest($request);
        $fForm->handleRequest($request);
        if($fForm->isSubmitted() ) {
        $equipement->setIdequiplogement($Logement);


            $em->persist($equipement);
            $em->flush();
            return $this->redirectToRoute('editLogement',array('idlogement'=>$idlogement));
//            return $this->redirect($this->generateUrl('editLogement',array('msg'=>"Edit successful")));
        }

        if($form->isSubmitted() ) {


            $em->persist($Logement);
            $em->flush();
            return $this->redirect($this->generateUrl('meslogements',array('msg'=>"Edit successful")));
        }
        return $this->render('GstayguesthostBundle:Logement:editLogement.html.twig',array(
            'form'=>$form->createView(),
            'fform'=>$fForm->createView(),
            'profile'=>$profile,
            'felicity'=>$equip,
            'a'=>$Logement
        ));




    }






    /**
     * @Route("/MesLogements",name="meslogements")
     */
    public function MesLogementsAction()
    {


        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();


        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayguesthostBundle:hostguest')->findOneBy(array('id_user' => $id ));

        $logement=$em->getRepository('GstayguesthostBundle:Logement')->findBy(array('idlogementuser'=>$profile));


        return $this->render('GstayguesthostBundle:Logement:mesLogements.html.twig',
            array('logements'=>$logement,'profile'=>$profile));



    }





        /**
         * @Route("/Equipement",name="Equipement")
         */
        public function EquimpeementAction(Request $request) {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();

        $Equipement = new Equipement();
        $em=$this->getDoctrine()->getManager();
            $profile = $em->getRepository('GstayguesthostBundle:hostguest')->findOneBy(array('id_user' => $id ));

        $equip = $em->getRepository('GstayguesthostBundle:Equipement')->findBy(array('idequiplogement' => $id ));
        $form = $this->createForm(EquipementType::class,$Equipement );


        $form->handleRequest($request);

        if($form->isSubmitted() ) {
            $em->persist($Equipement);
            $em->flush();
            return $this->redirect($this->generateUrl('Equipement',array('msg'=>"add successful")));
        }
        return $this->render('GstayguesthostBundle:Logement:LogementEquipement.html.twig',array(
            'form'=>$form->createView(),
            'profile'=>$profile,
            'felicity'=>$equip,



        ));




    }

    /**
     * @Route("/addEquipement",name="addEquipement")
     */
     public function addEquipementAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user)) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id = $this->getUser()->getId();

        $equipement = new Equipement();
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayguesthostBundle:hostguest')->findOneBy(array('id_user' => $id));


        $form = $this->createForm(EquipementType::class,$equipement);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $equipement >setIdUser($user);
            $em->persist($equipement);
            $em->flush();
            return $this->redirect($this->generateUrl('addEquipement', array('msg' => "add successful")));
        }
        return $this->render('GstayguesthostBundle:Logement:editLogement.html.twig', array(
            'form' => $form->createView(),
            'profile' => $profile


        ));


    }






    /**
     * @Route("/listBookings/{idlogements}",name="listBookings")
     */
    /*
    public function listBookingsAction($idlogements)
    {

        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();

        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayguesthostBundle:hostguest')->findOneBy(array('id_user' => $id ));


        $logements = $em->getRepository('GstayguesthostBundle:Logement')->findOneBy(array('idlogement' => $idlogements ));

        return $this->render('GstayguesthostBundle:Logement:list.html.twig',array("logements"=>$logements,"profile"=>$profile));
    }


*/

    /**
     * @Route("/addlogements",name="addlogement")
     */
     public function addLogementAction(Request $request)
    {


        $user = $this->getUser();
        if (!is_object($user)) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id = $this->getUser()->getId();

        $Logement = new Logement();
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayguesthostBundle:hostguest')->findOneBy(array('id_user' => $id));

        $form = $this->createForm(LogementType::class, $Logement  );


        $form->handleRequest($request);

        if($form->isSubmitted() ) {
            $Logement->setIdlogementuser($profile);

            $em->persist( $Logement );
            $em->flush();
            return $this->redirect($this->generateUrl('addlogement',array('msg'=>"add successful")));
        }
        return $this->render('GstayguesthostBundle:Logement:addlogment.html.twig',array(
            'form'=>$form->createView(),
            'profile'=>$profile,
            'logement'=>$Logement



        ));



    }



}