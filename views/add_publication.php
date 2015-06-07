<?php
  define('PROJ_PATH', $_SERVER['DOCUMENT_ROOT'].'/CSE532-Final/');
  include_once PROJ_PATH.'lib/functions.php';
  // TODO: redirect if no user is logged in
  // if (!isset($_SESSION['username'])) { }
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
    <?php require PROJ_PATH.'/includes/navbar.php'; ?>
    <div class="container-fluid">
      <div class="span8">
        <form class="form-horizontal" action="../controllers/add_publication_controller.php"
        method="POST">
          <!-- article title -->
          <div class="form-group">
            <label for="inputArtTitle" class="control-label col-xs-2">Article Title</label>
            <div class="col--10">
              <input type="text" class="form-control" id="inputArtTitle" placeholder="Article Title">
            </div>
          </div>
          <!-- abstract -->
          <div class="form-group">
            <label for="inputAbstract" class="control-label col-xs-2">Abstract</label>
            <div class="col--10">
              <textarea class="form-control" id="inputAbstract" placeholder="Abstract"></textarea>
            </div>
          </div>
          <!-- date published -->
          <div class="form-group">
            <label for="inputPubDate" class="control-label col-xs-2">Date Published</label>
            <div class="col--10">
              <input type="text" class="form-control" id="inputPubDate" placeholder="Date Published">
            </div>
          </div>
          <!-- vol -->
          <div class="form-group">
            <label for="inputPubDate" class="control-label col-xs-2">Date Published</label>
            <div class="col--10">
              <input type="text" class="form-control" id="inputPubDate" placeholder="Date Published">
            </div>
          </div>
          <!-- countries -->
          <div class="form-group">
            <label for="inputCountry" class="control-label col-xs-2">Country Published</label>
            <div class="col--10">
              <?php produce_dropdown(PROJ_PATH.'resources/countries.txt','inputCountry'); ?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php require PROJ_PATH.'/includes/footer.php'; ?>
  </body>

</html>

<?php
  // article title
  // abstract
  // publication date
  // start_pg
  // end_pg
  // impact_factor
  // country
  // journal
    // vol
    // issue
  // conference
  // authors
?>
