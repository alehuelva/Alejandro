<?php
  
//for ($i=0; $i<10; $i++){
	//$errorsfile = file_get_contents("http://kunstmaan.airbrake.io/errors.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff&page=".$i);
  
  $errorsfile =file_get_contents("http://kunstmaan.airbrake.io/errors.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff");
  $xmlerrors = new SimpleXMLElement($errorsfile);

  
   $projectsfile =file_get_contents("http://kunstmaan.airbrake.io/data_api/v1/projects.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff");
   $xmlprojects = new SimpleXMLElement($projectsfile);
   
   $projects= array();
   $projectsname = array ();
 
   
   foreach ($xmlprojects->project as $proj) {
   $projects[(int)$proj->id] = 0;
   $projectsname[(int)$proj->id] = $proj -> name;
   //$projects[(int)$proj->id][$name] = (string)$proj->name;
   
   } 
   
   foreach ($xmlerrors->group as $group) {
   	$projects[(int)$group -> {'project-id'}]++;
   }var_dump ($projects);
   
   
   
   echo '<table border="1">
   <tr>
   <th>name</th>
   <th>number</th>
   <th>cont</th>

   </tr>';
   foreach($projects as $proj => $cont){
   	echo '<tr>
   	<td>' . $projectsname[(int)$proj] . '</td>
   	<td>' . $proj . '</td>
   	<td>' . $cont . '</td>

   	</tr>';
   }

   
   
   
   //$projects=array (array( $id, $cont));
	//$projects= array();
   
   //foreach ($xmlprojects->project as $proj  ) {
   //$projects[] = $proj -> id  ;}
   
	/*foreach ($xmlprojects->project as $proj => $id) {
		$projects[$id] = $proj -> id;
		$projects[$id] = 'foo';
	}   var_dump ($projects); die();*/

   
  /* foreach ($xmlerrors->group as $group) {
   	$projects[$group -> {'project-id'}]++;
   	var_dump ($projects[]);
   }*/
   
/*$errors=array();
   foreach ($xmlerrors->group as $group) {
   	$errors = $group -> {'project-id'};
   }
   
   foreach ($errors[$id] as $item)
   	 	 if (in_array ($item, $projects[])){
			echo "si";   	 	
   	 	 }
   echo "fin";
   
   
   Mostrar proyecto
   echo $projects[5][$id]; die();*/