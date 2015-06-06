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

  <!-- MAIN -->
  <div class="hero-unit page">
    <center>
      <h1> Welcome! </h1>
      SUNY.Korea.Article.Publications
    </center>
    <div class="container-fluid" style="margin-top:20px">
    </div>
  </div>
  <!-- MAIN END-->

  <?php
    // load footer
    require PROJ_PATH.'/includes/footer.php';
  ?>
</body>

</html>
