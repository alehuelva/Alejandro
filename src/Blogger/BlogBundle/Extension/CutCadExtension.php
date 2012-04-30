<?php
namespace Blogger\BlogBundle\Extension;

class CutCadExtension extends \Twig_Extension {


	public function getFilters() {
		return array(
				'cutcad'  => new \Twig_Filter_Method($this, 'cutcad'),
		);
	}

	public function cutcad($comment, $limit=50) {

		$length = strlen($comment);
			
		if ($length < 0 ){
			$comm ='There is no comment';
		}
		else if ($length < $limit) {
			$comm = $comment;
		}
		else {
			$comm = substr($comment, 0, $limit);
		}

		return $comm;
	}


	public function getName()
	{
		return 'cut_cad_extension';
	}

}