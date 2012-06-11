<?php
function db_connect(){
  $host     = "localhost"; 
  $username = "alejandro";
  $password = "huJbGZECRe3WKNxd"; // Replace with your password
  $database = "alejandro";
  
  $link = mysql_connect($host, $username, $password);
  if(!$link){
    exit('Could not connect to database: '. mysql_error());
  }
  
  $selected = mysql_select_db($database);
  if(!$selected){
    exit("Could not select database '$database'");
  }
}

?>