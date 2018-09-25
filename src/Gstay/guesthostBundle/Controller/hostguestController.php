<?php
/**
 * Created by PhpStorm.
 * User: HD_EXECUTION
 * Date: 01/02/2017
 * Time: 15:50
 */

namespace Gstay\guesthostBundle\Controller;
use AppBundle\Entity;
use Gstay\guesthostBundle\Entity\hostguest;
use Gstay\guesthostBundle\Form\hostguestType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;

class hostguestController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('GstayguesthostBundle:Default:index.html.twig');
    }

    /**
     * @Route("/userprofile",name="profilehostguest")
     */
    public function profileAction()
    {

        $user = $this->getUser();
        $id =  $this->getUser()->getId();

        $email = $this->getUser()->getemail();

        if (!is_object($user) ) {

            return $this->redirectToRoute('fos_user_security_login');
        }

        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayguesthostBundle:hostguest')->findOneBy(array('id_user' => $id ));
        $newid = $em->getRepository('AppBundle:User')->findOneBy(array('id' => $id ));

        if(empty($profile))
        {
            $profile= new hostguest();

            $profile->setIdUser($newid);
            $profile->setDateInscrit(new \DateTime());


            $em->persist($profile);
            $em->flush();

            return $this->render('GstayguesthostBundle:interface:profile.html.twig',array(
                'profile'=>$profile,
                'email'=>$email
            ));
        }



        return $this->render('GstayguesthostBundle:interface:profile.html.twig',array(
            'profile'=>$profile,
            'email'=>$email
        ));

    }

    /**
     * @Route("/usersetting",name="setting")
     */
    public function usersettingAction(Request $request)
    {


        $user = $this->getUser();
        $id =  $this->getUser()->getId();

        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('GstayguesthostBundle:hostguest')->findOneBy(array('id_user' => $id ));
        $form = $this->createForm(hostguestType::class,$profile );


        $form->handleRequest($request);

        if($form->isSubmitted() )
        {

            $em->persist($profile);
            $em->flush();
            return $this->redirect($this->generateUrl('profilehostguest'));
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

        return $this->render('GstayguesthostBundle:interface:SettingProfile.html.twig',array(
            'form1'=>$form1->createView(),
            'form'=>$form->createView(),
            'profile'=>$profile

        ));

    }

    /**
     * @Route("/review",name="review")
     */
    public function ReviewAction()
    {
        return $this->render('GstayguesthostBundle:interface:userreview.html.twig');
    }
    /**
     * @Route("/map",name="map")
     */
    public function mapAction()
    {
        return $this->render('GstayguesthostBundle:Logement:map.html.twig');
    }

    /**
     * @Route("/listlogement",name="listbooking")
     */
    public function ListLogementAction()
    {
        return $this->render('GstayguesthostBundle:Logement:listlogement.html.twig');
    }


}
