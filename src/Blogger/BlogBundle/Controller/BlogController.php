<?php
// src/Blogger/BlogBundle/Controller/BlogController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
/**
 * Blog controller.
 */
class BlogController extends Controller
{
/**
 * Show a blog entry
 * @Route("/{id}/{slug}", requirements={"id" = "\d+"}, name="BloggerBlogBundle_blog_show")
 * @Method({"GET"})
 */
 public function showAction($id, $slug)
  {
       $em = $this->getDoctrine()->getEntityManager();
       $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($id);
      if (!$blog) {
           throw $this->createNotFoundException('Unable to find Blog post.');
      }
       $comments = $em->getRepository('BloggerBlogBundle:Comment')
	              ->getCommentsForBlog($blog->getId());
    return $this->render('BloggerBlogBundle:Blog:show.html.twig', array(
	    'blog'      => $blog,
	    'comments'  => $comments
          ));
    }
}

