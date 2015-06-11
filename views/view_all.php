<?php
  session_id('mySessionID');
  session_start();
  define('PROJ_PATH', $_SERVER['DOCUMENT_ROOT'].'/CSE532-Final/');
  include_once PROJ_PATH.'lib/functions.php';
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
    <div>
      <input type="text" class="span5 search-query">
    </input>
      <!-- <button type="submit" class="btn"><i class="icon-search"></i></button> -->
    </div>
    <div>
      <?php all_publications_table(); ?>
      <?php require PROJ_PATH.'/includes/footer.php'; ?>
    </div>
  </body>
</html>
