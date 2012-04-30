<?php
// src/Blogger/BlogBundle/Controller/CommentController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Comment;
use Blogger\BlogBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Comment controller.
 */
class CommentController extends Controller
{

    public function newAction($blog_id) //Render the Form for a new comment
    {
        $blog = $this->getBlog($blog_id);

        $comment = new Comment();
        $comment->setBlog($blog);
        $form   = $this->createForm(new CommentType(), $comment);

        return $this->render('BloggerBlogBundle:Comment:form.html.twig', array(
            'comment' => $comment,
            'form'   => $form->createView()
        ));
    }
    
    
    /**
     * @Route("/comment/{blog_id}", requirements={"blog_id" = "\d+"}, name="BloggerBlogBundle_comment_create")
     * @Method({"POST"})
     */
    public function createAction($blog_id) //Create the comment, is used inside the new comment view, once the form has been rended, it sent 
    {
        $blog = $this->getBlog($blog_id);

        $comment  = new Comment();  //New comment
        $comment->setBlog($blog);   //The id blog is keeped in the instance
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment); //Commenttype is the class where we hold the details of our form
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()
		       ->getEntityManager();
	    $em->persist($comment); //This is related with the persistance in the database, im actually not sure
	    $em->flush(); //This attempts to push current output all the way to the browser

            return $this->redirect($this->generateUrl('BloggerBlogBundle_blog_show', array( //generate the url with the show action
                'id' => $comment->getBlog()->getId(),  //
		'slug' => $comment->getBlog()->getSlug())) .
                '#comment-' . $comment->getId()
            );
        }

        return $this->render('BloggerBlogBundle:Comment:create.html.twig', array( //rendder the view
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }
      
    /**
     * @Route("/{blog_id}/{comment_id}/abuse", requirements={"blog_id" = "\d+", "comment_id" = "\d+"}, name="BloggerBlogBundle_comment_abuse")
     * @Method({"GET", "POST"})
     */    
    public function abuseAction($blog_id, $comment_id){
    	//public function abuseAction(){
    	 
    	// $blog_id= $this->getBlog()->getId();
    	// $comment_id= $this->getId();
    	//$parameters = array(($blog_id), ($comment_id));
    	
    	
    	
    	$parameters = array(('blog_id') => $blog_id, ('comment_id')=> $comment_id);
    	
       	$message = \Swift_Message::newInstance()  // Perform some action, we create the instance of the mail
    	//->setSubject()
    	->setFrom('enquiries@symblog.co.uk')
    	->setTo($this->container->getParameter('blogger_blog.emails.contact_email'))
    	->setBody($this->renderView('BloggerBlogBundle:Comment:abuseEmail.txt.twig', array('parameters' => $parameters)));
    	$this->get('mailer')->send($message); //envía mensaje
    	$this->get('session')->setFlash('blogger-notice', 'Your report was successfully sent. Thank you!'); // Flash message
    
    	
    	//Redirect
    	
    	//$em = $this->getDoctrine()->getEntityManager(); 
    	//$blog = $em->getRepository('BloggerBlogBundle:Blog')->find($blog_id); //recover the blog and its URL using id and slug atributes
    	//if (!$blog) {
    	//	throw $this->createNotFoundException('Error cargando blog.');
    	//}
    	//$comments = $em->getRepository('BloggerBlogBundle:Comment')
    	//->getCommentsForBlog($blog->getId());
    	
    	
    	//All the commented code over this line, is already in the function getBlog()
    	$blog= $this->getBlog($blog_id); //Recover the blog, and after it, use its ID and slug
    	
    	return $this->redirect($this->generateUrl('BloggerBlogBundle_blog_show', array(
    			'id' => $blog->getId(),
    			'slug' => $blog->getSlug())) 
    	);
    	
    	
    	
    }
    
    
    
    
    

    protected function getBlog($blog_id) //Return the full instance of the class blog given its id
    {
        $em = $this->getDoctrine()
                    ->getEntityManager();

        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($blog_id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $blog;
    }

}
