<?php
namespace Blogger\BlogBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Mistakes\MistakesTestBundle\LoadXml;
use Mistakes\MistakesTestBundle\Entity\Error;
use Doctrine\ORM\EntityRepository;




class UpdateCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
		->setName('BlogBoundle:update')
		->setDescription('Update database')
		//->addArgument('name', InputArgument::OPTIONAL, 'arguments description')
		//->addOption('yell', null, InputOption::VALUE_NONE, 'options')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		
		$obj = new LoadXml();
		$xmlprojects = $obj->loadProjects();
		$obj->resetErrors($xmlprojects);
		$page = 0;
		//** Load errors in array $temperror and keep them in database
		$xmlerrors = 1;
		while ($xmlerrors) {
			$xmlerrors = $obj->loadErrors($page);
			$obj->setErrors($xmlerrors);
			$page++;
		}
		$temperror = ($obj->getErrors());
		//** Keep in database
		foreach ($temperror as $key => $error) {
			$prueba = 0;
			$em = $this->getContainer()->get('doctrine')->getEntityManager();
			$prueba = $em->getRepository('MistakesTestBundle:Error')->findOneByName($error['name']);
			if (!$prueba) {      //** CREATE
				$errordoctr = new Error();
				$errordoctr->setAbId($key);
				$errordoctr->setName($error['name']);
				$errordoctr->setCont($error['cont']);
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($errordoctr);
			}
			else {              //UPDATE
				$conttemp = $prueba->getCont();
				if ($error['cont'] != $conttemp) {
					$prueba->setCont($error['cont']);
				}
			}
		}
		$em->flush();
		$text = 'Database updated';
		$output->writeln($text);
		
	}
}
