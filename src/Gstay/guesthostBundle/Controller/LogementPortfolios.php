<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 15/02/2017
 * Time: 14:20
 */

namespace Gstay\guesthostBundle\Controller;
use Gstay\guesthostBundle\Form\LogementPortfolioType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Gstay\guesthostBundle\Entity\Logement;
use Gstay\guesthostBundle\Entity\hostguest;
use Gstay\guesthostBundle\Entity\LogementPortfolio;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LogementPortfolios extends Controller
{

    /**
     * @Route("/LogementportfolioSetting/{idlogement}", name="LogementportfolioSetting")
     */
    public function LogementportfolioSettingAction(Request $request ,$idlogement) {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();


        $em=$this->getDoctrine()->getManager();

        $profile = $em->getRepository('GstayguesthostBundle:hostguest')->findOneBy(array('id_user' => $id ));


        $logement = $em->getRepository('GstayguesthostBundle:Logement')->findOneBy(array('idlogement' => $idlogement ));




        $LogemntPortfolios = $em->getRepository('GstayguesthostBundle:LogementPortfolio')->findBy(array('id_user' => $idlogement ));

        $LogemntPortfolio = new LogementPortfolio();

        $form = $this->createForm(LogementPortfolioType::class,$LogemntPortfolio );


        $form->handleRequest($request);

        if($form->isSubmitted() ) {
            $LogemntPortfolio->setIdUser($logement);
            $em->persist($LogemntPortfolio);
            $em->flush();
            return $this->redirect($this->generateUrl('LogementportfolioSetting',array('msg'=>"add successful",'idlogement'=>$idlogement)));
        }


        return $this->render('GstayguesthostBundle:Logement:LogementPortfolio.html.twig',array(
            'form'=>$form->createView(),
            'logement'=>$logement,
            'profile'=>$profile,
            'LogemntPortfolio'=>$LogemntPortfolios,




        ));




    }
    /**
     * @Route("/deletelogementPortfolio/{id}",name="deletelogementPortfolio")
     */
    public function deletelogementPortfolioAction($id)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }



        $em=$this->getDoctrine()->getManager();
        $portfolio = $em->getRepository('GstayguesthostBundle:LogementPortfolio')->findOneBy(array('id' => $id ));



        $em->remove($portfolio);
        $em->flush();
        return $this->redirect($this->generateUrl('meslogements',array('msg'=>"delete successful")));





    }
}