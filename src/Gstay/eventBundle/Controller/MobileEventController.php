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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;

class MobileEventController extends Controller
{

    /**
     * @Route("/showEventsMobile",name="listeEventMobile")
     */
    public function listAction()
    {


        $event = new evenement();
        $em=$this->getDoctrine()->getManager();
        $event = $em->getRepository('GstayeventBundle:evenement')->findBy(array('id_organisateur'=>1));

        $response = array();
        foreach ($event as $event) {
            $response[] = array(
                'title' => $event->getTitre(),
                'theme' => $event->getTheme(),
                // other fields
            );
        }


        return new JsonResponse($response);



    }

    /**
     * @Route("/service/imagesEvent", name="images_event_json")
     */
    public function getImagesJson(\Symfony\Component\HttpFoundation\Request $r){
        $repo= $this->getDoctrine()->getRepository("TahwissaBundle:Image");
        $repoEvent= $this->getDoctrine()->getRepository("TahwissaBundle:Evenement");

        $images= $repo->findBy(array("evenement"=>$repoEvent->find($r->get("event_id"))));
        return new JsonResponse($images);
    }


}