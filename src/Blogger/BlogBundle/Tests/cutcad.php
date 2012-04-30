<?php 
class MyTwigExtension{// extends \Twig_Extension 

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

}

$cadena='aaaaaaaaaaaaaaaabbbbbbbbbbbbbbbbnnnnnnnnnnnnn';
$cadenb='aaaaaaaaaaan';

echo $cadena;
echo cutcad($cadena);
echo cutcad($cadenb);
?>