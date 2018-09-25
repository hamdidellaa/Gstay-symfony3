<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 15/02/2017
 * Time: 12:48
 */

namespace Gstay\forumBundle\Controller;
use Gstay\forumBundle\Entity\Blog;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gstay\forumBundle\Form\BlogType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class BlogController extends Controller

{
    /**
     * @Route("/Blog", name="Blog")
     * @Method("GET")
     */
    public function BlogAction()
    {
        $em = $this->getDoctrine()->getManager();

        $Blog = $em->getRepository('GstayforumBundle:Blog')->findAll();

        return $this->render('GstayforumBundle:Blog:listBlog.htm.twig', array(
            'Blog' => $Blog,
        ));
    }
    /**
     * @Route("/BlogDetail/{id_Blog}",name="BlogDetail")
     */
    public function BlogDetailAction($id_Blog)
    {


        $em=$this->getDoctrine()->getManager();
        $Blog = $em->getRepository('GstayforumBundle:Blog')->findOneBy(array('id_Blog' =>$id_Blog ));


            return $this->render('GstayforumBundle:Blog:detailBlog.htm.twig',array("Blog"=>$Blog));

    }

    /**
     * Creates a new Blog entity.
     *
     * @Route("/new", name="new")
     * @Security("is_granted('ROLE_MODERATOR')")
     */
    public function newAction(Request $request)
    {
        $Blog = new Blog();
        $form = $this->createForm('Gstay\forumBundle\Form\BlogType', $Blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $Blog->setIdUser($user);
            $em->persist($Blog);
            $em->flush($Blog);
            return $this->redirect($this->generateUrl('Blog',array('msg'=>"add successful")));

        }

        return $this->render('GstayforumBundle:Blog:newBlog.html.twig', array(
            'Blog' => $Blog,
            'form' => $form->createView(),
        ));
    }
    /**
     *  edit Blog entity.
     *
     * @Route("/editBlog/{id_Blog}", name="editBlog")
     * @Security("is_granted('ROLE_MODERATOR')")
     */
    public function editBlogAction(Request $request,$id_Blog)
    {
        $Blog = new Blog();

        $em = $this->getDoctrine()->getManager();
        $Blog = $em->getRepository('GstayforumBundle:Blog')->findOneBy(array('id_Blog'=>$id_Blog));
        $form = $this->createForm('Gstay\forumBundle\Form\BlogType', $Blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($Blog);
            $em->flush($Blog);
            return $this->redirect($this->generateUrl('Blog',array('msg'=>"add successful")));

        }

        return $this->render('GstayforumBundle:Blog:newBlog.html.twig', array(
            'Blog' => $Blog,
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a topic entity.
     *
     * @Route("/delateBlog/{id_Blog}", name="delateBlog")
     * @Security("is_granted('ROLE_MODERATOR')")
     */
    public function delateBlogAction($id_Blog)
    {
        $em=$this->getDoctrine()->getManager();
        $Blog = $em->getRepository('GstayforumBundle:Blog')->findOneBy(array('id_Blog' => $id_Blog ));

        $em->remove($Blog);
        $em->flush();

        return $this->redirect($this->generateUrl('Blog'));
    }


}