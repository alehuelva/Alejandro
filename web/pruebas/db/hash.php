<?php
if(isset($_POST['password'])){
  $salt = sha1($_POST['password'] . microtime());
  $password = sha1($salt . $_POST['password']);
}

?><!DOCTYPE html>
<html>
<head>
  <title>Hash Generator</title>
  <style>
    label{ margin-top: 10px; display: block;}
  </style>
</head>
<body>
  <h1>Hash Generator</h1>
  <?php if(isset($password)): ?>
    <h2>Result</h2>
    <label for="result_salt">Salt</label>
    <input size="64" readonly id="result_salt" value="<?php echo $salt ?>">
    
    <label for="result_password">Password</label>
    <input size="64" readonly id="result_password" value="<?php echo $password ?>">
    <hr>
  <?php endif; ?>
  <form action="hash.php" method="POST">
    <label for="password">Password</label>
    <input type="text" name='password' />
    <input type="submit" value="Go" />
  </form>