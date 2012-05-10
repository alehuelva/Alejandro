<?php 


class Mistakes {
	
	protected $errors= array(); //Array with errors
	protected $projectsname = array ();
	
	
	public function loadProjects() { // Get projects from xml
		
		//$url = "http://kunstmaan.airbrake.io/data_api/v1/projects.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff";
		//$xmlprojects = simplexml_load_file($url);
		$projectsfile =file_get_contents("http://kunstmaan.airbrake.io/data_api/v1/projects.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff");
		$xmlprojects = new SimpleXMLElement($projectsfile);
		return $xmlprojects;
	}
	
	
	public function loadErrors($pageid=0) { //get errors from xml
		$errorsfile =file_get_contents("http://kunstmaan.airbrake.io/errors.xml?auth_token=5047b6b5e6910cafa77422f04d06ae2097bd05ff&page=" . $pageid);
		$xmlerrors = new SimpleXMLElement($errorsfile);
		return $xmlerrors;
	}
	
	
	public function resetErrors($xmlprojects) { //Reset the accounting of errors in the array before to be filled in
		if ($xmlprojects != NULL){
			foreach ($xmlprojects->project as $proj) {
				$this->errors[(int)$proj->id] = 0;
			}
		} else echo "Error loading errors";
		
		//return ?
		}
		
		
	public function setProjectname($xmlprojects){
		if ($xmlprojects != NULL){
			foreach ($xmlprojects->project as $proj) {
				$this->projectsname[(int)$proj->id] = (string) $proj -> name;
			}
		} else echo "Error loading projects";
	}
	
	

  	public function setErrors($xmlerrors) {
			if ($xmlerrors != NULL){
				foreach ($xmlerrors->group as $group) {
				$this->errors[(int)$group -> {'project-id'}]++;
				}
			}else echo "Error loading errors";
  	}
  	
  	
 
  	public function getErrors(){
  		return $this->errors;
  	}
  	
  	
  	
  	public function getProjectname(){
  		return $this->projectsname;
  	}
  	
  	

 }
 
 

  	$obj= new Mistakes();
  	
  	$xmlprojects = $obj -> loadProjects();
  	$xmlerrors = $obj ->  loadErrors(10);
  	$obj -> resetErrors($xmlprojects); 
  	$obj -> setErrors($xmlerrors); 
  	$obj -> setProjectname($xmlprojects);
    $temperror= ($obj -> getErrors());  
    $tempproj= ($obj -> getProjectname()); 

  	
  	
  	
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

  