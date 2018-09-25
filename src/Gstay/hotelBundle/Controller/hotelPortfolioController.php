<?php

namespace Gstay\hotelBundle\Controller;

use Gstay\hotelBundle\Entity\hotelPortfolio;
use Gstay\hotelBundle\Form\hotelPortfolioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class hotelPortfolioController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/hotel_portfolio_settings", name="hotel_portfolio_settings")
     */
    public function hotel_portfolioSettingsAction(Request $request) {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();

        $hotelPortfolio = new hotelPortfolio();
        $em=$this->getDoctrine()->getManager();
        $Hotel = $em->getRepository('GstayhotelBundle:Hotel')->findOneBy(array('id_user' => $id ));
        $hid=$Hotel->getId();
        $hotelPortfolios = $em->getRepository('GstayhotelBundle:hotelPortfolio')->findBy(array('id_user' => $hid ));

        $form = $this->createForm(hotelPortfolioType::class,$hotelPortfolio );


        $form->handleRequest($request);

        if($form->isSubmitted() ) {
            $hotelPortfolio->setIdUser($Hotel);
            $em->persist($hotelPortfolio);
            $em->flush();
            return $this->redirect($this->generateUrl('hotel_portfolio_settings',array('msg'=>"add successful")));
        }
        return $this->render('GstayhotelBundle:pages:manage_hotelPortfolio.html.twig',array(
            'form'=>$form->createView(),
            'Hotel'=>$Hotel,
            'hotelPortfolios'=>$hotelPortfolios,




        ));




    }
    /**
     * @Route("/delete_hotelPortfolio/{id}",name="delete_hotelPortfolio")
     */
    public function deletehotelPortfolioAction($id)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }



        $em=$this->getDoctrine()->getManager();
        $portfolio = $em->getRepository('GstayhotelBundle:hotelPortfolio')->findOneBy(array('id' => $id ));

        $em->remove($portfolio);
        $em->flush();

        return $this->redirect($this->generateUrl('hotel_portfolio_settings',array('msg'=>"Delete successful")));





    }
}
