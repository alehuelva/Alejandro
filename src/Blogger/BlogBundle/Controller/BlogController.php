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
 public function showAction($id, $slug)  //This action returns the view of one entry of the blog, defined by its ID and Slug
  {
       $em = $this->getDoctrine()->getEntityManager(); 
       $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($id);
      if (!$blog) {
           throw $this->createNotFoundException('Unable to find Blog post.'); //If blog doesnt exist
           
      }
       $comments = $em->getRepository('BloggerBlogBundle:Comment')  //Get comments
	              ->getCommentsForBlog($blog->getId());
    return $this->render('BloggerBlogBundle:Blog:show.html.twig', array( //Return the view with the blog and the comments
	    'blog'      => $blog,
	    'comments'  => $comments
          ));  //Show the view of the blog and its comments
    }
}

