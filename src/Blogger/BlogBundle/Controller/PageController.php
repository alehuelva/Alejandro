<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Enquiry;
use Blogger\BlogBundle\Form\EnquiryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;



     //The class PageController use the entitymanager class to recover all the blog posts, blogs will be an atributte in the index view
class PageController extends Controller
{
	//Here the anotations are for routing, each time we call pagecontroller we are going to the main page /
/**
 * @Route("/", name="BloggerBlogBundle_homepage")
 * @Method({"GET"})
 */
	    public function indexAction()
	    {
		    $em = $this->getDoctrine()
			       ->getEntityManager();

		    $blogs = $em->getRepository('BloggerBlogBundle:Blog')
			        ->getLatestBlogs();
		    return $this->render('BloggerBlogBundle:Page:index.html.twig', array(
			    'blogs' => $blogs 
		     // and with render we show the index view, with the attribute blogs.
		    ));
	}
	
	
	//The about controller just render the qbout view
	
/**
 * @Route("/about" , name="BloggerBlogBundle_about")
 */
	    public function aboutAction()
	    {
		    return $this->render('BloggerBlogBundle:Page:about.html.twig');
	    }
	    
	    
	    
	    
/**
 * @Route("/contact", name="BloggerBlogBundle_contact")
 * @Method({"GET","POST"})
 */
	    public function contactAction()
	    {
            $enquiry = new Enquiry(); //Creating a new enauiry with all fields to fill in for sending mail
	    $form = $this->createForm(new EnquiryType(), $enquiry); //Creating a form and saving dates in $enauiry
	    $request = $this->getRequest();
	       if ($request->getMethod() == 'POST') {  	//Checking the html method, it should be POST
	        $form->bindRequest($request);
				if ($form->isValid()) {           // Perform some action, we create the instance of the mail
				$message = \Swift_Message::newInstance()
				->setSubject('Contact enquiry from symblog')
				->setFrom('enquiries@symblog.co.uk')
				->setTo($this->container->getParameter('blogger_blog.emails.contact_email'))
				 		//With this parameter located in ...Resources/config/config.yml we keep the email to send
						//We use one parameter to change the mail for whatever method in the blog that sends a mail
				->setBody($this->renderView('BloggerBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
						//We fill the template of the mail with the dates keeped in enquiry
				$this->get('mailer') ->send($message);     //This method sends the mail
						
				$this->get('session')->setFlash('blogger-notice','Your contact enquiry was successfully sent, Thank you!');
						//With this one we show a flag confirming the sent

           				// Redirect - This redirect to the contact page
           return $this->redirect($this->generateUrl('BloggerBlogBundle_contact'));
		            }
	    }
       return $this->render('BloggerBlogBundle:Page:contact.html.twig', array(
					        'form' => $form->createView()
						    )); //It shows the view, with the attribute form
	    }

	    
	    
	    public function sidebarAction()
{
	$em = $this->getDoctrine()
		   ->getEntityManager();

	$tags = $em->getRepository('BloggerBlogBundle:Blog')  //We trap the tags from the entity manager, the own blog
		   ->getTags();

	$tagWeights = $em->getRepository('BloggerBlogBundle:Blog')
			 ->getTagWeights($tags);
	$commentLimit = $this->container
				->getParameter('blogger_blog.comments.latest_comment_limit'); //The same with comments
	$latestComments = $em->getRepository('BloggerBlogBundle:Comment')
				->getLatestComments($commentLimit);

	return $this->render('BloggerBlogBundle:Page:sidebar.html.twig',array( //Now sidebar view will receibe attributes latestcomments and tags
		'latestComments'	=> $latestComments,
		'tags' 			=> $tagWeights
	));
}
}
