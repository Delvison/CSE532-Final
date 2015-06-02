<?php
  session_id('mySessionID');
  session_start();
?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script src="js/jquery-2.1.3.min.js"></script>
</head>

<body>
  <?php
  // load navbar
  require $_SERVER['DOCUMENT_ROOT'].'/includes/navbar.php';
  ?>

  <!-- MAIN -->
  <div class="hero-unit page">
    <center>
      <h1> Welcome! </h1>
    </center>
    <div class="container-fluid" style="margin-top:20px">
    </div>
  </div>
  <!-- MAIN END-->

  <?php
    // load footer
    require $_SERVER['DOCUMENT_ROOT'].'/idea/includes/footer.php';
  ?>
</body>

</html>
