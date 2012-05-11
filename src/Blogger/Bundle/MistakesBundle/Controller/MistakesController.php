<?php

namespace Blogger\Bundle\MistakesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Blogger\Bundle\MistakesBundle;



class MistakesController extends Controller {

	//PROBANDO
		public function indexAction()
		{
			$obj=new loadxml();
			
			 
			$xmlprojects = $obj -> loadProjects();
			$xmlerrors = $obj ->  loadErrors(10);
			$obj -> resetErrors($xmlprojects);
			$obj -> setErrors($xmlerrors);
			$obj -> setProjectname($xmlprojects);
			$temperror= ($obj -> getErrors());
			$tempproj= ($obj -> getProjectname());
			
			 
			return $this->render('BloggerBlogBundle:Comment:create.html.twig', array( //rendder the view
					'errors' => $temperror,
					'projects' => $tempproj
			));
			 
			echo '<table border="1">
			<tr>
			<th>name</th>
			<th>number</th>
			<th>cont</th>
			 
			</tr>';
			foreach($temperror as $proj => $cont){
				echo '<tr>
				<td>' . $tempproj[(int)$proj] . '</td>
				<td>' . $proj . '</td>
				<td>' . $cont . '</td>
				 
				</tr>';
			}
			echo '</table>';
			
			
			
			//return new Response('<html><body>Hello</body></html>');
		}
	
	

}







/*class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('BloggerMistakesBundle:Default:index.html.twig');
    }
}*/
