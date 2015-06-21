<?php
  session_id('mySessionID');
  session_start();
  define('PROJ_PATH', $_SERVER['DOCUMENT_ROOT'].'/CSE532-Final/');
  include_once PROJ_PATH.'lib/functions.php';
  include_once PROJ_PATH.'models/publication_model.php';
?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </head>

  <body>
    <?php require PROJ_PATH.'/includes/navbar.php'; ?>
    <div class="span8 offset2">
      <?php get_publication($_GET['t']); ?>
    </div>
    <?php //require PROJ_PATH.'/includes/footer.php'; ?>
  </body>
</html>
