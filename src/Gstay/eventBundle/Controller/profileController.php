<?php
/**
 * Created by PhpStorm.
 * User: HD_EXECUTION
 * Date: 01/02/2017
 * Time: 15:43
 */

namespace Gstay\eventBundle\Controller;
use Gstay\eventBundle\Form\profileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use AppBundle\Entity\User;
use Gstay\eventBundle\Entity\profile;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class profileController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {

       /* $user = $this->getUser();
        $id=0;
        if(!empty($user))
        {
            $id=$this->getUser()->getId();

        }


         $this->render('GstayeventBundle:Default:layout.html.twig',array(
            'id'=>$id
        ));*/

      //  return $this->render('test.html.twig');
        $d=0;
        return  $d;
    }

    /**
     * @Route("/profile", name="profileEvent")
     */
    public function profileAction()
    {
        $user = $this->getUser();
        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();
        $msg = 0;
        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user' => $id ));
        $newid = $em->getRepository('AppBundle:User')->findOneBy(array('id' => $id ));
        if(empty($profile))
        {
            $profile= new profile();
            $profile->setIdUser($newid);
            $profile->setDateInscrit(new \DateTime());
            $profile->setImageName("namous.jpg");
            $em->persist($profile);
            $em->flush();
            return $this->render('GstayeventBundle:profile:myProfile.html.twig',array(
                'profile'=>$profile,
                'errorevent'=>0,
                'errortour'=>0,
                'msg'=>$msg

            ));
        }

        $event = $em->getRepository('GstayeventBundle:evenement')->findBy(array('id_organisateur'=>$id));
        //  controle sur le status //
        $error = 0;
        $datenow = new \DateTime('now');
        foreach ($event as $e)
        {
            if($e->getDateDebut() < $datenow || $e->getNbTicket()<1)
            {
                if($e->getStatut()!="inactive")
                {
                    $error++;
                    $e->setStatut('inactive');
                    $em->persist($e);
                    $em->flush();
                }
            }else
            {
                $e->setStatut('actif');
                $em->persist($e);
                $em->flush();
            }

        }

        $tour = $em->getRepository('GstayeventBundle:tour')->findBy(array('id_organisateur'=>$id));

        //  controle sur le status //
        $error1 = 0;
        $datenow = new \DateTime('now');
        foreach ($tour as $t)
        {
            if($t->getDatedebut() < $datenow || $t->getMaxplace()<1)
            {
                if($t->getStatut()!="inactive")
                {
                    $error1++;
                    $t->setStatut('inactive');
                    $em->persist($t);
                    $em->flush();
                }

            }else
            {
                $t->setStatut('actif');
                $em->persist($t);
                $em->flush();
            }

        }

        //  controle sur lles messages //
        $message = $em->getRepository('GstayeventBundle:message')->findBy(array('idreciver'=>$id));

        foreach ($message as $m)
        {
            if($m->getLu() == "nonlu" )
            {
                $msg++;
            }

        }




        return $this->render('GstayeventBundle:profile:myProfile.html.twig',array(
            'profile'=>$profile,
            'errorevent'=>$error,
            'errortour'=>$error1,
            'msg'=>$msg

        ));
    }

    /**
     * @Route("/profileSetting", name="profileEventSetting")
     */
    public function profilSettingAction(Request $request)
    {


        $user = $this->getUser();
        $id =  $this->getUser()->getId();

        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayeventBundle:profile')->findOneBy(array('id_user' => $id ));
        $form = $this->createForm(profileType::class,$profile );


        $form->handleRequest($request);

        if($form->isSubmitted() )
        {

            $em->persist($profile);
            $em->flush();
            return $this->redirect($this->generateUrl('profileEvent'));
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

        return $this->render('GstayeventBundle:profile:SettingProfile.html.twig',array(
            'form1'=>$form1->createView(),
            'form'=>$form->createView(),
         'profile'=>$profile

        ));

    }
}