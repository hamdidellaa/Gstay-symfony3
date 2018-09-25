<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 16/02/2017
 * Time: 02:39
 */

namespace Gstay\guesthostBundle\Controller;


use Gstay\guesthostBundle\Entity\reservationLogement;
use Gstay\guesthostBundle\Form\reservationLogementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class reservationController extends Controller
{

    /**
     * @Route("/addreservation/{idLogement}",name="addreservation")
     */
    public function addreservationAction(Request $request, $idLogement)
    {
        $user = $this->getUser();
        if (!is_object($user)) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id = $this->getUser()->getId();

        $reservation = new reservationLogement();
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayguesthostBundle:hostguest')->findOneBy(array('id_user' => $id));
        $logement = $em->getRepository('GstayguesthostBundle:Logement')->findOneBy(array('idlogement' => $idLogement));


        $form = $this->createForm(reservationLogementType::class, $reservation);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $logement->setNbrchambredispo($logement->getNbrchambredispo() - $reservation->getNbrchambrereserver());
            $reservation->setIdguest($profile);
            $reservation->setIdreservationlogement($logement);
            $em->persist($reservation);
            $em->flush();
            return $this->redirect($this->generateUrl('listreservation', array('msg' => "add successful")));
        }
        return $this->render('GstayguesthostBundle:Reservation:addreservation.html.twig', array(
            'form' => $form->createView(),
            'profile' => $profile,
            'logement'=>$logement


        ));
    }

    /**
     * @Route("/listreservation",name="listreservation")
     */
    public function listreservationAction()
    {
        $user = $this->getUser();
        if (!is_object($user)) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id = $this->getUser()->getId();

        $reservation = new reservationLogement();
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayguesthostBundle:hostguest')->findOneBy(array('id_user' => $id));

        $reservation = $em->getRepository('GstayguesthostBundle:reservationLogement')->findBy(array('idguest'=>$profile));
        return $this->render('GstayguesthostBundle:Reservation:listreservation.html.twig',
            array('reservation' => $reservation, 'profile' => $profile));

    }

    /**
     * @Route("/deletereservation/{id}",name="deletereservation")
     */
    public function deletereservationAction($id)
    {
        $user = $this->getUser();
        if (!is_object($user)) {

            return $this->redirectToRoute('fos_user_security_login');
        }


        $em = $this->getDoctrine()->getManager();

        $reservation = $em->getRepository('GstayguesthostBundle:reservationLogement')->findOneBy(array('idreservation' => $id));
        $idd=$reservation->getIdreservationlogement();

        $logement = $em->getRepository('GstayguesthostBundle:Logement')->findOneBy(array('idlogement' => $idd));

        $logement->setNbrchambredispo($logement->getNbrchambredispo() + $reservation->getNbrchambrereserver());

        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute('listreservation');
    }




}






