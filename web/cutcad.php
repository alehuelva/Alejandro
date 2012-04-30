<?php 
namespace Blogger\BlogBundle\Extension;

class CutCadExtension extends \Twig_Extension {
	
	
	public function getFilters() {
		return array(
				'cutcad'  => new \Twig_Filter_Method($this, 'cutcad'),
		);
	}

 	public function cutcad($comment, $limit=20) {
		
			$length = strlen($comment);
			
			if ($length < 0 ){
				$cutcad ='There is no comment';
				}
				else if ($length < $limit) {
					$cutcad = $comment;
				}
				else {
					$cutcad = substr($comment, 0, $limit);
				}
				
			return $cutcad;
		}

		
		public function getName()
		{
			return 'cut_cad_extension';
		}
		
		
		
}	

//$cadena='aaaaaaaaaaaaaaaabbbbbbbbbbbbbbbbnnnnnnnnnnnnn';
//$cadenb='aaaaaaaaaaan';

//echo cutcad($cadena) . "\n";
//echo cutcad($cadenb);
?>