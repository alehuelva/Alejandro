<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Mistakes\MistakesTestBundle\LoadXml;
use Mistakes\MistakesTestBundle\Entity\Error;
use SaadTazi\GChartBundle\DataTable;
use SaadTazi\GChartBundle\Chart\PieChart;


class MistakesController extends Controller {

	//$ app/console BlogBoundle:update	 (Command to execute in console)
	
	public function grafAction()
	{   
			/*** UPDATE DATABASE IN CONSOLE -> $ app/console BlogBoundle:update	 (Command to execute in console)


					/* DELETE DATABASE
					 * $repository = $this->getDoctrine()
					 * ->getRepository('MistakesTestBundle:Error');
					 * $temperror = $repository->findAll();
					 * $em = $this->getDoctrine()->getEntityManager();
					 * $query = $em->createQuery(
					 * 'DELETE MistakesTestBundle:Error'
					 * );
					 * $errors = $query->getResult();
					 * //$em->persist($errors);
					 * //$em->flush();
					*/
		
			//** Create an array $temperror containing the database
			$repository = $this->getDoctrine()
				->getRepository('MistakesTestBundle:Error');
			$temperror = $repository->findAll();
			$dataTable2 = new DataTable\DataTable();
			$dataTable2->addColumn('id1', 'Error', 'string');
			$dataTable2->addColumnObject(new DataTable\DataColumn('id2', 'Errors', 'number'));
			foreach ($temperror as $tablaerror) {
				$dataTable2->addRow(array($tablaerror->getName(), $tablaerror->getCont()));
				
			}
			$dataTable2 = $dataTable2->toArray();
			$charts = array($dataTable2, $temperror); 
			
			return $this->render('MistakesTestBundle:Mistakes:index.html.twig', array( //rendder the view
					'charts' => $charts,
			));
			}
}