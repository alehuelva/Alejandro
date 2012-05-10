  <?php
  
  	// WORK leer xml externo pillado de forosdelweb tutorial
  	//header("Content-type: text/html; charset=utf-8");
  	//$rss_forosdelweb = file_get_contents("http://kunstmaan.airbrake.io/errors.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff");
  	//$xml = new SimpleXMLElement($rss_forosdelweb);
	//var_dump($xml);
   
  

  $errorsfile =file_get_contents("http://kunstmaan.airbrake.io/errors.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff");
  $xmlerrors = new SimpleXMLElement($errorsfile);

   $projectsfile =file_get_contents("http://kunstmaan.airbrake.io/data_api/v1/projects.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff");
   $xmlprojects = new SimpleXMLElement($projectsfile);
   //var_dump($xml);


   $projects=array (array( $id,
   					       $cont));
   
   					           
   foreach ($xmlprojects->project as $proj) {
   //echo $proj->name;
    $projects[][$id] = $proj -> id;
   }//var_dump($projects);

   
   
   $errors=array();
   foreach ($xmlerrors->group as $group) {
   	$errors[] = $group -> {'project-id'};
   } var_dump($errors);die();
   
   
   
   foreach ($errors as $err) {
   	foreach ($projects[][$id] as $proj){
   		if (in_array($proj, $err)){
   			$proj[$id]++;
   		}
   	}
   	
   }
 
   
   	
   	
   
   
   
   

   
   //$array = array_values($array);

// Now delete every item, but leave the array itself intact:
//foreach ($id as &$value) {
  //  echo $value;
   
   //$j=0;
   
   //for ($j=0;j<$i+1;$j++){
   
   //echo ($id[$j]);
   //foreach ($id[$j] as $idshow){
   	//echo $idshow.'   ';
   //	$j++;
   //}
   
  /*for ($i=0; $i<43; $i++){
	$errores = file_get_contents("http://kunstmaan.airbrake.io/errors.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff&page=".$i);

	
	$groups = new SimpleXMLElement($errores);
    foreach ($groups->group as $sese) {
     foreach ($sese->{'project-id'} as $dif){
       
     }
     }
    }
    
    http://kunstmaan.airbrake.io/data_api/v1/projects.xml
    */
    
   
    // 	$i=0;
   // foreach($groups->group as $group){
    //	//foreach($group->id as $id){
    	//    if ($group->{'project-id'} == 67546){
    	//$i+1;
    	    //}
   //  }
    //}
    //$f=5;
    //if ($f == 5){echo 'true';}
    
    //echo $i;
