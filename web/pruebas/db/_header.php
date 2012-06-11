<?php
session_start();
require_once "includes/database.php";
db_connect();
require_once "includes/auth.php";
$current_user = current_user();


// Call require_login() if needed
// This must be done before any output is sent
// because a header() based redirect is used
if($login_required){
  require_login();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">	
	<link rel="stylesheet" href="css/main.css">
	
	<title><?php echo $title; ?></title>
</head>
<body>
  <div id="header">
    <h1>Site Title <sup>&reg;</sup></h1>
    <div class="session">
      <?php if($current_user): ?>
        <strong>
          Logged in as <?php echo $current_user['first_name']; ?>
          <a href="logout.php">Log Out</a>
        </strong>
      <?php else: ?>
        <a href="login.php">Log In</a> 
        or
        <a href="register.php">Register</a> 
      <?php endif; ?>
    </div>
  </div>
  <div id="body">
    <ul id="navigation">
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="news.php">News</a></li>
      <li><a href="products.php">Products</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="login.php">Log In</a></li>
    </ul>
    <div id="content">
    <h2><?php echo $title; ?></h2>