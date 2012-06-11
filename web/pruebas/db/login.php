<?php 
$title = "Log In!";

include "_header.php"; 
?>

<?php if($_GET['error'] == '1'): ?>
  <h3 class="error">Username and/or Password are incorrect</h3>
<?php endif ?>

<?php if($_GET['login_required'] == '1'): ?>
  <h3 class="error">You must log in to view this page.</h3>
<?php endif ?>


<form action="authenticate.php" method="POST">
  <label for="username">Email Address</label>
  <input type="text" name="username" id="username">
  <label for="password">Password</label>
  <input type="password" name="password" id="password" >
  <input type="submit" value="Log In" >
</form>
<?php include "_footer.php"; ?>