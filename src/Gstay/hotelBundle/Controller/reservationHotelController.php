<?php

namespace Gstay\hotelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
class reservationHotelController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    /**
     * @Route("/reservation_detail/{id}",name="reservation_detail")
     */
    public function hotelDetailAction($id)
    {
        $user = $this->getUser();
        $id =  $this->getUser()->getId();
        $email = $this->getUser()->getemail();

        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }

        $em=$this->getDoctrine()->getManager();
        $Hotel = $em->getRepository('GstayhotelBundle:Hotel')->findOneBy(array('id_user' => $id ));
        $reservation = $em->getRepository('GstayhotelBundle:reservationHotel')->findAll(array('id' => $id ));




        return $this->render('GstayhotelBundle:pages:offer_detail.html.twig',array("reservation"=>$reservation,));

    }

    /**
     * @Route("/mybookingshotel", name="mybookingshotel")
     */
    public function reservationAction()
    {
        $user = $this->getUser();
        $id =  $this->getUser()->getId();
        $email = $this->getUser()->getemail();

        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }

        $em=$this->getDoctrine()->getManager();
        $Hotel = $em->getRepository('GstayhotelBundle:Hotel')->findOneBy(array('id_user' => $id ));

        $reservation = $em->getRepository('GstayhotelBundle:reservationHotel')->findBy(array('id_user' => $id ));




        return $this->render('GstayhotelBundle:pages:Mybookings.html.twig',array(
            'Hotel'=>$Hotel,
            'email'=>$email,
            'reservation'=>$reservation
        ));
    }
    /**
     * @Route("/bookingshotel", name="bookingshotel")
     */
    public function reservationofhotelAction()
    {
        $user = $this->getUser();
        $id =  $this->getUser()->getId();
        $email = $this->getUser()->getemail();

        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }

        $em=$this->getDoctrine()->getManager();
        $Hotel = $em->getRepository('GstayhotelBundle:Hotel')->findOneBy(array('id_user' => $id ));

        $reservation = $em->getRepository('GstayhotelBundle:reservationHotel')->findBy(array('id_user' => $id ));




        return $this->render('GstayhotelBundle:pages:Mybookings.html.twig',array(
            'Hotel'=>$Hotel,
            'email'=>$email,
            'reservation'=>$reservation
        ));
    }
}
