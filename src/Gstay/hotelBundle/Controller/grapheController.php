<?php

namespace Gstay\hotelBundle\Controller;

use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Gstay\hotelBundle\Entity\reservationHotel;
use Gstay\hotelBundle\Entity\promoHotel;
use Zend\Json\Expr;

class grapheController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/linechart/{id}",name="linechart")
     */
    public function chartListAction($id)
    {  $user = $this->getUser();
        $idd =  $this->getUser()->getId();
        $email = $this->getUser()->getemail();

        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }

        $em=$this->getDoctrine()->getManager();
        $Hotel = $em->getRepository('GstayhotelBundle:Hotel')->findOneBy(array('id_user' => $idd ));





        $promoHotels=$em->getRepository("GstayhotelBundle:promoHotel")->findby(array('id_hotel'=>$id));

        $count = array();

        foreach ($promoHotels as $promoHotel) {
            $reservation=$em->getRepository("GstayhotelBundle:reservationHotel")->findBy(array('idpromo'=>$promoHotel->getId()));
            $a=count($reservation);
            $d =array( $promoHotel->getName(),$a);
            array_push($count,$d);
        }

        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Reservations per Offer');

        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false,
                'format' => '{point.name}: {point.y:.1f}%'),
            'showInLegend'  => true
        ));
        $data =$count;

        $ob->series(array(array('type' => 'pie','name' => 'Number of Reservations', 'data' => $data)));
            return $this->render('GstayhotelBundle:pages:LineChart.html.twig',array('chart'=>$ob,'Hotel'=>$Hotel));

        }

}
