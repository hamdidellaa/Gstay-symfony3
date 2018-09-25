<?php

namespace Gstay\hotelBundle\Controller;

use Gstay\hotelBundle\Entity\room;
use Gstay\hotelBundle\Form\roomType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class roomController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/room_settings", name="room_settings")
     */
    public function hotel_roomSettingsAction(Request $request) {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();

        $room = new room();
        $em=$this->getDoctrine()->getManager();
        $Hotel = $em->getRepository('GstayhotelBundle:Hotel')->findOneBy(array('id_user' => $id ));
        $hid=$Hotel->getId();
        $rooms = $em->getRepository('GstayhotelBundle:room')->findBy(array('id_hotel' => $hid ));
        $form = $this->createForm(roomType::class,$room );


        $form->handleRequest($request);

        if($form->isSubmitted() ) {
            $room->setIdHotel($Hotel);
            $em->persist($room);
            $em->flush();
            return $this->redirect($this->generateUrl('room_settings',array('msg'=>"add successful")));
        }
        return $this->render('GstayhotelBundle:pages:hotel_room.html.twig',array(
            'form'=>$form->createView(),
            'Hotel'=>$Hotel,
            'rooms'=>$rooms,



        ));




    }

    /**
     * @Route("/edit_room/{name}",name="edit_room")
     */
    public function editroomAction(Request $request,$name)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();


        $em=$this->getDoctrine()->getManager();
        $Hotel = $em->getRepository('GstayhotelBundle:Hotel')->findOneBy(array('id_user' => $id ));

        $room = $em->getRepository('GstayhotelBundle:room')->findOneBy(array('name' => $name ));
        $form = $this->createForm(roomType::class,$room );

        $rooms = $em->getRepository('GstayhotelBundle:room')->findBy(array('id_hotel' => $id ));
        $form->handleRequest($request);

        if($form->isSubmitted() ) {

            $em->persist($room);
            $em->flush();
            return $this->redirect($this->generateUrl('room_settings',array('msg'=>"Edit successful")));
        }
        return $this->render('GstayhotelBundle:pages:edit_room.html.twig',array(
            'form'=>$form->createView(),
            'Hotel'=>$Hotel,
            'rooms'=>$rooms,


        ));




    }

    /**
     * @Route("/delete_room/{id}",name="delete_room")
     */
    public function deleteroomAction($id)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }



        $em=$this->getDoctrine()->getManager();
        $room = $em->getRepository('GstayhotelBundle:room')->findOneBy(array('id' => $id ));

        $em->remove($room);
        $em->flush();

        return $this->redirect($this->generateUrl('room_settings',array('msg'=>"Delete successful")));





    }
}
