<?php
$title = "Register";
include "_header.php";

$errors = array();

// If request is a form submission
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  // Validation

  // Check first_name is non-blank
  if(0 === preg_match("/\S+/", $_POST['first_name'])){
    $errors['first_name'] = "Please enter a first name.";
  }
  
  // Check last_name is non-blank
  if(0 === preg_match("/\S+/", $_POST['last_name'])){
    $errors['last_name'] = "Please enter a last name.";
  }
  
  // Check email is valid (enough)
  if(0 === preg_match("/.+@.+\..+/", $_POST['email'])){
    $errors['email'] = "Please enter a valid email address.";
  }
  
  // Check password is valid
  if(0 === preg_match("/.{6,}/", $_POST['password'])){
    $errors['password'] = "The password entered was invalid";
  }
  
  // Check password confirmation_matches
  if(0 !== strcmp($_POST['password'], $_POST['password_confirmation'])){
    $errors['password_confirmation'] = "Passwords do not match";
  }
  
  // If no validation errors
  if(0 === count($errors)){
    
    // Sanitize first, last, and email
    $first_name = mysql_real_escape_string($_POST['first_name']);
    $last_name  = mysql_real_escape_string($_POST['last_name']);
    $email      = mysql_real_escape_string($_POST['email']);

    // Generate pseudo-random salt
    $salt = sha1(microtime() . $_POST['password']);
  
    // Generate password from salt
    $password = sha1($salt . $_POST['password']);
  
  
    // Insert user into the database
    $query = "INSERT INTO `users` 
             ( `first_name`,  `last_name`,  `email`,  `salt`,  `password`)
             VALUES
             ('$first_name', '$last_name', '$email', '$salt', '$password')";
  
    $result = mysql_query($query); //Lo guardamos pero no lo utilizamos, se graba y se guarda la respuesta TRUE o FALSE si se ha guardao o no
   
    if(mysql_errno() === 0){ //Si hay dos emails iguales por ejemplo da error
      // Registration successful
      $user_id = mysql_insert_id();
      log_in($user_id);
      header("Location: index.php");
    } elseif (preg_match("/^Duplicate.*email.*/i", mysql_error())){
      $errors['email'] = "Email has already been used.";
    }  
  }
}

// Helpers
function form_row_class($name){
  global $errors;
  return $errors[$name] ? "form_error_row" : "";
}

function error_for($name){
  global $errors;
  if($errors[$name]){
    return "<div class='form_error'>" . $errors[$name] . "</div>";
  }
}

function h($string){
  return htmlspecialchars($string);
}

?>
<form action="register.php" method="POST">
  <table class="form">
    <tr class="<?php echo form_row_class("first_name") ?>" >
      <th><label for="first_name">First Name</label></th>
      <td>
        <input name="first_name" id="first_name" type="text" value="<?php echo h($_POST['first_name']); ?>" />
        <?php echo error_for('first_name') ?>
      </td>
    </tr>
    <tr class="<?php echo form_row_class("last_name") ?>">
      <th><label for="last_name">Last Name</label></th>
      <td>
        <input name="last_name" id="last_name" type="text" value="<?php echo h($_POST['last_name']); ?>" />
        <?php echo error_for('last_name') ?>
      </td>
    </tr>
    <tr class="<?php echo form_row_class("email") ?>">
      <th><label for="email">Email Address</label></th>
      <td>
        <input name="email" id="email" type="text" value="<?php echo h($_POST['email']); ?>" />
        <?php echo error_for('email') ?>
      </td>
    </tr>
    <tr class="<?php echo form_row_class("password") ?>">
      <th>
        <label for="password">Password</label>
      </th>
      <td>
        <input name="password" id="password" type="password"  />
        <?php echo error_for('password') ?>
      </td>
    </tr>
    <tr class="<?php echo form_row_class("password_confirmation") ?>">
      <th><label for="password_confirmation">Confirm Password</label></th>
      <td>
        <input name="password_confirmation" id="password_confirmation" type="password" />
        <?php echo error_for('password_confirmation') ?>
      </td>
    </tr>
    <tr>
      <th></th>
      <td><input type="submit" value="Register" /></td>
    </tr>
  </table>
</form>
<?php
include "_footer.php";
?>
