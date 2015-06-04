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

  ?>
  <div class="hero-unit page" style="margin-right:20%;margin-left:20%">
    <div class="container-fluid">
      <h2>Signup for Idea!</h2>
      <form action="controllers/login_controller.php" method="POST">
        <input style="height:30px" type="text" placeholder="username" name="username" id="username" />
      </br>
      <p>
        <input style="height:30px" type="text" placeholder="email" name="email" id="email"/>
        <p id="email_status"></p>
      </p>
      <p>
        <input style="height:30px" type="password" placeholder="password" name="password" id="password" />
        <p id="passwd_status"></p>
      </p>
      <input style="display:none" name="action" value="create_user"></input>
      <button type="submit" class="btn-primary">signup</button>
    </form>
    <p>
      Already have an account?
      <a href="login.php">Login</a>
    </p>
  </div>
</div>
<?php
// load navbar

?>

<script>
$(document).ready(function()
{
  $('#password').bind('input',function()
{
  if ( check_passwd( $('#password').val() ) ){
    $('#passwd_status').text('good password');
    $('#passwd_status').css('color','#00933b');
  } else {
    $('#passwd_status').text('bad password');
    $('#passwd_status').css('color','#cc0000');
  }
});
});

$(document).ready(function()
{
  var error = '<?php echo $_GET['error']; ?>';
  if (error == 'invalid_passwd') {
    alert("Password should contain at least one number, "+
    "one lower case character, one upper case character, "+
    "and be of length eight.");
  }
  if (error == 'invalid_username') {
    alert("Username should be of lenght four or more.");
  }
  if (error == 'failed') {
    alert("Oops! Email or username already exists.");
    $('#email').val("<?php echo $_GET['email'] ?>");
    $('#username').val("<?php echo $_GET['username'] ?>");
  }
  if (error == 'invalid_email') {
    alert("Oops! Email doesn't appear to be valid.");
    $('#email').val("<?php echo $_GET['email'] ?>");
    $('#username').val("<?php echo $_GET['username'] ?>");
  }
});
</script>
</body>

</html>
