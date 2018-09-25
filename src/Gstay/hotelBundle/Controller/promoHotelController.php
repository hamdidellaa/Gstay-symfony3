<?php

namespace Gstay\hotelBundle\Controller;

use Doctrine\ORM\Query\AST\Functions\CurrentDateFunction;
use Gstay\hotelBundle\Entity\promoHotel;
use Gstay\hotelBundle\Form\promoHotelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class promoHotelController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/promo_list",name="promo_list")
     */
    public function hotelPromolistAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $promoHotel=$em->getRepository("GstayhotelBundle:promoHotel")->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');

        $result= $pagination = $paginator->paginate(
            $promoHotel, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 6)
        );

        return $this->render('GstayhotelBundle:pages:hotel_offer_list.html.twig',array(
            "promoHotel"=>$result));
    }

    /**
     * @Route("/promo_hotel",name="promo_hotel")
     */
    public function profile_promoAction () {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();

        $promoHotel = new promoHotel();
        $em=$this->getDoctrine()->getManager();
        $Hotel = $em->getRepository('GstayhotelBundle:Hotel')->findOneBy(array('id_user' => $id ));
   $idh=$Hotel->getId();
        $promoHotel = $em->getRepository('GstayhotelBundle:promoHotel')->findBy(array('id_hotel'=>$idh));



        return $this->render('GstayhotelBundle:pages:hotel_profile_offer_list.html.twig',array(
            'promoHotel'=>$promoHotel,
            'Hotel'=>$Hotel,
            'msg'=>"Edit successful"


        ));
    }

    /**
     * @Route("/add_promo",name="add_promo")
     */
    public function addPromoAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();

        $promoHotel = new promoHotel();
        $em=$this->getDoctrine()->getManager();
        $Hotel = $em->getRepository('GstayhotelBundle:Hotel')->findOneBy(array('id_user' => $id ));

        $hid=$Hotel->getId();
        $form = $this->createForm(promoHotelType::class,$promoHotel );


        $form->handleRequest($request);

        if($form->isSubmitted() ) {
            $promoHotel->setIdHotel($Hotel);
           // $x=$promoHotel->getId();
          //  var_dump($x);
            $em->persist($promoHotel);
            $em->flush();
            return $this->redirect($this->generateUrl('add_promo',array('msg'=>"add successful")));
        }
        return $this->render('GstayhotelBundle:pages:add_promo.html.twig',array(
            'form'=>$form->createView(),
            'Hotel'=>$Hotel,



        ));




    }


    /**
     * @Route("/edit_promo/{name}",name="edit_promo")
     */
    public function editPromoAction(Request $request,$name)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();


        $em=$this->getDoctrine()->getManager();
        $Hotel = $em->getRepository('GstayhotelBundle:Hotel')->findOneBy(array('id_user' => $id ));

        $promoHotel = $em->getRepository('GstayhotelBundle:promoHotel')->findOneBy(array('name' => $name ));
        $form = $this->createForm(promoHotelType::class,$promoHotel );


        $form->handleRequest($request);

        if($form->isSubmitted() ) {

            $em->persist($promoHotel);
            $em->flush();
            return $this->redirect($this->generateUrl('promo_hotel',array('msg'=>"Edit successful")));
        }
        return $this->render('GstayhotelBundle:pages:edit_promo.html.twig',array(
            'form'=>$form->createView(),
            'Hotel'=>$Hotel,



        ));




    }

    /**
     * @Route("/delete_promo/{id}",name="delete_promo")
     */
    public function deletePromoAction($id)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }



        $em=$this->getDoctrine()->getManager();
        $promoHotel = $em->getRepository('GstayhotelBundle:promoHotel')->findOneBy(array('id' => $id ));

        $em->remove($promoHotel);
        $em->flush();

        return $this->redirect($this->generateUrl('promo_hotel',array('msg'=>"Delete successful")));





    }
    /**
     * @Route("/offer_detail/{id}",name="offer_detail")
     */
    public function hotelDetailAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $promoHotel = $em->getRepository('GstayhotelBundle:promoHotel')->findOneBy(array('id' => $id ));




        return $this->render('GstayhotelBundle:pages:offer_detail.html.twig',array("promoHotel"=>$promoHotel,));

    }
    /**
     * @Route("/search_promo",name="search_promo")
     */
    public function searchpromoAction (Request $request,Request $requestrech){
        $em=$this->getDoctrine()->getManager();
        $promoHotel = $em->getRepository('GstayhotelBundle:promoHotel')->findAll();
        if($requestrech->isMethod('POST'))
        {
            $countryrech= $request->get('countryrech');
            $datebegin= $request->get('datebegin');
            $dateend= $request->get('dateend');
            var_dump($datebegin);
 if (!empty($countryrech ) && (!empty($datebegin)) && (!empty($dateend))  )//3cas
 {
     $query = $em->createQuery('SELECT p FROM GstayhotelBundle:promoHotel p WHERE (

               ( SELECT h.country FROM GstayhotelBundle:Hotel h WHERE ( p.id_hotel = h.id ) ) = :country) AND 
               
               
               p.date_begin=:datebegin AND p.date_end=:dateend');
     $query->setParameters(array(
         'country' => $countryrech,
         'datebegin' => $datebegin,
         'dateend' => $dateend,


     ));
 }
            elseif (!empty($countryrech ) && ((empty($datebegin)) or (empty($dateend)))  )//country sec
            {
                $query = $em->createQuery('SELECT p FROM GstayhotelBundle:promoHotel p WHERE (

               ( SELECT h.country FROM GstayhotelBundle:Hotel h WHERE ( p.id_hotel = h.id ) ) = :country)');
                $query->setParameters(array(
                    'country' => $countryrech,



                ));
            }
           else
            {
                $query = $em->createQuery('SELECT p FROM GstayhotelBundle:promoHotel p ');}


            /**
             * @var $paginator \Knp\Component\Pager\Paginator
             */
            $paginator  = $this->get('knp_paginator');

            $result= $pagination = $paginator->paginate(
                $query, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                $request->query->getInt('limit', 1)
            );

        }





        return $this->render('GstayhotelBundle:pages:hotel_offer_list.html.twig',array("promoHotel"=>$result,));
    }
}
