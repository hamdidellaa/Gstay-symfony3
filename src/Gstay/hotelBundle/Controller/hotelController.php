<?php
/**
 * Created by PhpStorm.
 * User: HD_EXECUTION
 * Date: 01/02/2017
 * Time: 15:46
 */

namespace Gstay\hotelBundle\Controller;

use Gstay\hotelBundle\Form\HotelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;
use Gstay\hotelBundle\Entity\Hotel;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class hotelController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
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

        return $this->render('GstayhotelBundle:pages:index.html.twig',array("Hotelafrica"=>$africashow , "Hoteleurope"=>$europeshow,"Hotelasia"=>$asiashow,"Hotelamerica"=>$americashow,"Hotelaustralia"=>$australiashow));
    }

    /**
     * @Route("/hotel_list",name="hotel_list")
     */
    public function hotel_listAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $Hotel=$em->getRepository("GstayhotelBundle:Hotel")->findAll();
       // $dql="SELECT H FROM GstayhotelBundle:Hotel H";
          //  $Hotel->$em->createQuery($dql);
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');

       $result= $pagination = $paginator->paginate(
           $Hotel, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 6)
        );

        return $this->render('GstayhotelBundle:pages:hotel_list.html.twig',array("Hotel"=>$result));
    }
    /**
     * @Route("/hotel_detail",name="hotel_detail")
     */
    public function hotel_detailAction()
    {
        return $this->render('GstayhotelBundle:pages:hotel_detail.html.twig');

    }
    /**
     * @Route("/hotel_offer_list",name="hotel_offer_list")
     */
    public function hotel_offer_listAction()
    {
        return $this->render('GstayhotelBundle:pages:hotel_offer_list.html.twig');

    }
    /**
     * @Route("/hotel_profile", name="hotel_profile")
     */
    public function hotel_profileAction()
    {
        $user = $this->getUser();
        $id =  $this->getUser()->getId();
        $email = $this->getUser()->getemail();

        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }

        $em=$this->getDoctrine()->getManager();
        $Hotel = $em->getRepository('GstayhotelBundle:Hotel')->findOneBy(array('id_user' => $id ));
        $newid = $em->getRepository('AppBundle:User')->findOneBy(array('id' => $id ));
        if(empty($Hotel))
        {
            $Hotel= new Hotel();

            $Hotel->setIdUser($newid);
            $Hotel->setDateInscrit(new \DateTime());
            $Hotel->setUpdatedAt(new \DateTime());
            $Hotel->setImageName("namous.jpeg");
            $em->persist($Hotel);
            $em->flush();

            return $this->render('GstayhotelBundle:pages:myProfile.html.twig',array(
                'Hotel'=>$Hotel,
                'email'=>$email
            ));
        }



        return $this->render('GstayhotelBundle:pages:myProfile.html.twig',array(
            'Hotel'=>$Hotel,
            'email'=>$email
        ));
    }

    /**
     * @Route("/hotel_ProfileSettings", name="hotel_ProfileSettings")
     */
    public function hotel_profilSettingsAction(Request $request)
    {


        $user = $this->getUser();
        $id =  $this->getUser()->getId();

        $em=$this->getDoctrine()->getManager();
        $Hotel = $em->getRepository('GstayhotelBundle:Hotel')->findOneBy(array('id_user' => $id ));
        $form = $this->createForm(HotelType::class,$Hotel );


        $form->handleRequest($request);

        if($form->isSubmitted() )
        {

            $em->persist($Hotel);
            $em->flush();
            return $this->redirect($this->generateUrl('hotel_profile'));
        }





        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.change_password.form.factory');

        $form1 = $formFactory->createForm();
        $form1->setData($user);

        $form1->handleRequest($request);

        if ($form1->isSubmitted() && $form1->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form1, $request);
            $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('GstayhotelBundle:pages:SettingsProfileHotel.html.twig',array(
            'form1'=>$form1->createView(),
            'form'=>$form->createView(),
            'Hotel'=>$Hotel

        ));

    }



    /**
     * @Route("/hotel_detail/{id}",name="hotel_detail")
     */
    public function hotelDetailAction($id)
    {


        $em=$this->getDoctrine()->getManager();
        $Hotel = $em->getRepository('GstayhotelBundle:Hotel')->findOneBy(array('id' => $id ));
        $rooms = $em->getRepository('GstayhotelBundle:room')->findBy(array('id_hotel' => $id ));
        $felicity = $em->getRepository('GstayhotelBundle:facilities')->findBy(array('id_hotel' => $id ));
        $promos = $em->getRepository('GstayhotelBundle:promoHotel')->findBy(array('id_hotel' => $id ));

        $hotelPortfolios = $em->getRepository('GstayhotelBundle:hotelPortfolio')->findBy(array('id_user' => $id ));


        return $this->render('GstayhotelBundle:pages:hotel_detail.html.twig',array("Hotel"=>$Hotel,'hotelPortfolios'=>$hotelPortfolios,'rooms'=>$rooms,'felicity'=>$felicity,'promos'=>$promos));

    }
    /**
     * @Route("/",name="")
     */
    public function hotel_listindexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $Hotel=$em->getRepository("GstayhotelBundle:Hotel")->findBy(array(), array('stars' => 'DESC'));



        return $this->render('GstayhotelBundle:pages:index.html.twig',array("Hotel"=>$Hotel));
    }
}