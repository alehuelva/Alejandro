<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Mistakes\MistakesTestBundle\loadxml;
use Mistakes\MistakesTestBundle\Entity\Error;
use SaadTazi\GChartBundle\DataTable;
use SaadTazi\GChartBundle\Chart\PieChart;



class MistakesController extends Controller {


	public function grafAction()
	{   
		$obj=new loadxml();
		$xmlprojects = $obj -> loadProjects();
		$obj -> resetErrors($xmlprojects);
		$page=0;
			
		//**********Load errors from all xml in array $temperror and keep them in database
		$xmlerrors = 1;
		while ($xmlerrors) {
			$xmlerrors = $obj ->  loadErrors($page);
			$obj -> setErrors($xmlerrors);
			$page++; }
		$temperror= ($obj -> getErrors());

		//**********Inserting or updating in database
		foreach ($temperror as $key => $error){
			$prueba=0;
			$em = $this->getDoctrine()->getEntityManager();
			$prueba = $em->getRepository('MistakesTestBundle:Error')->findOneByName($error['name']);
				
			if (!$prueba){      //CREATE
				$errordoctr = new Error();
				$errordoctr->setAbId($key);
				$errordoctr->setName($error['name']);
				$errordoctr->setCont($error['cont']);
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($errordoctr);
			}
			else{              //UPDATE
				$conttemp = $prueba->getCont();
				if ($error['cont'] != $conttemp){
					$prueba->setCont($error['cont']);
				}
			}
		}$em->flush();
			
					/* DELETE DATABASE
					$repository = $this->getDoctrine()
					->getRepository('MistakesTestBundle:Error');
					$temperror = $repository->findAll();
					$em = $this->getDoctrine()->getEntityManager();
					$query = $em->createQuery(
						'DELETE MistakesTestBundle:Error'
					);
					$errors = $query->getResult();
					//var_dump($errors);die();
					//$em->persist($errors);
					//$em->flush();
					*/
		
		
		//**********Create an array $temperror containing the objects from doctrine database
				
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery(
				'SELECT a FROM Mistakes\MistakesTestBundle\Entity\Error a ORDER BY a.cont DESC');
		$temperror = $query->getResult(); // array of Error objects

		//********** Creating the graphic
		$dataTable2 = new DataTable\DataTable();
		$dataTable2->addColumn('id1', 'prueba', 'string');
		$dataTable2->addColumnObject(new DataTable\DataColumn('id2', 'Errores', 'number'));
			
		foreach ($temperror as $tablaerror)
			$dataTable2->addRow(array($tablaerror->getName(), $tablaerror->getCont()));

		//**********Returning the view
		return $this->render('BloggerBlogBundle:Page:mistakes.html.twig', array( //rendder the view
				'errors' => $temperror,
				'dataTable2' => $dataTable2->toArray()
		));

			
	}
}