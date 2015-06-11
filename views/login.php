<?php
  session_id('mySessionID');
  session_start();
  define('PROJ_PATH', $_SERVER['DOCUMENT_ROOT'].'/CSE532-Final/');
?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body>

  <?php
    // load navbar
    require PROJ_PATH.'/includes/navbar.php';
  ?>

  <div class="hero-unit page" style="margin-right:20%;margin-left:20%">
    <div class="container-fluid">
      <h2>Login</h2>
      <form action="../controllers/login_controller.php" method="POST">
        <input style="height:30px" type="text" placeholder="username" name="username" />
      </br>
      <input style="height:30px" type="password" placeholder="password" name="password" />
    </br>
    <input style="display:none" name="action" value="login"></input>
    <button type="submit" class="btn-primary">login</button>
  </form>
  <p>
    Don't have an account?
    <a href="create_user.php">Create an account</a>
  </p>
</div>
</div>

<?php
  // load footer
  require PROJ_PATH.'/includes/footer.php';
?>


<script>
$(document).ready(function()
{
  var error = '<?php echo $_GET['error']; ?>';
  var m = '<?php echo $_GET['m']; ?>';
  if (error == 'inc_pass') {
    alert("Username or password is incorrect");
  }
  if (error == 'login_first'){
    alert("Oops! Please login first.");
  }
  if (m == 'successfully_created'){
    alert("Success! Username created.");
  }
});
</script>
</body>
</html>
