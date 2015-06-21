<?php
  session_id('mySessionID');
  session_start();
  define('PROJ_PATH', $_SERVER['DOCUMENT_ROOT'].'/CSE532-Final/');
  include_once PROJ_PATH.'lib/functions.php';
  // TODO: redirect if no user is logged in
  if (!isset($_SESSION['username'])) {
    header("Location: ../views/login.php?error=login_first");
  }
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
    <div class="container-fluid">
      <div class="span8 offset2">
        <form class="form-horizontal" action="../controllers/add_publication_controller.php"
        method="POST" enctype="multipart/form-data">
          <!-- article title -->
          <div class="form-group">
            <label for="inputArtTitle" class="control-label col-xs-2">Article Title</label>
            <div class="col--10">
              <input type="text" class="style-4" id="inputArtTitle"
               name="inputArtTitle" placeholder="Article Title">
            </div>
          </div>
          <!-- abstract -->
          <div class="form-group">
            <label for="inputAbstract" class="control-label col-xs-2">Abstract</label>
            <div class="col--10">
              <textarea class="style-4" id="inputAbstract" name="inputAbstract"
               placeholder="Abstract"></textarea>
            </div>
          </div>
          <!-- date published -->
          <div class="form-group">
            <label for="inputPubDate" class="control-label col-xs-2">Date
               Published</label>
            <div class="col--10">
              <input type="date" class="style-4" id="inputPubDate"
               name="inputPubDate" placeholder="YYYY-MM-DD">
            </div>
          </div>
          <!-- authors -->
          <div class="form-group">
            <label for="inputAuthors" class="control-label col-xs-2">
              Authors</label>
            <div class="col--10">
              <input type="text" class="style-4" id="inputAuthors"
               name="inputAuthors"
              placeholder="Authors(comma separated)">
            </div>
          </div>
          <!-- countries -->
          <div class="form-group">
            <label for="inputCountry" class="control-label col-xs-2">Country
               Published</label>
            <div class="col--10">
              <?php produce_dropdown(PROJ_PATH.
                    'resources/countries.txt','inputCountry');
              ?>
            </div>
          </div>
          <!-- conference or journal -->
          <div class="form-group">
            <label for="type" class="control-label col-xs-2">Type</label>
            <div id="type">
              <input type="radio" class="radio" name="inputConfRadio"
               id="inputConfRadio" value="false" />
              <label for="inputConfRadio">Conference</label>
              <input type="radio" class="radio" name="inputJourRadio"
               id="inputJourRadio" value="false" />
              <label for="inputJourRadio">Journal</label>
          </div>
          <!-- div for conference name -->
          <div id='confInfo'>
            <!-- conference title -->
            <div class="form-group">
              <label for="inputConfName" class="control-label col-xs-2">
                Conference Name</label>
              <div class="col--10">
                <input type="text" class="style-4" id="inputConfName"
                 name="inputConfName" placeholder="Conference Name">
              </div>
            </div>
            <!-- date of conference -->
            <div class="form-group">
              <label for="inputConfDate" class="control-label col-xs-2">
                Conference Date</label>
              <div class="col--10">
                <input type="date" class="style-4" id="inputConfDate"
                 name="inputConfDate" placeholder="YYYY-MM-DD">
              </div>
            </div>
          </div>
          <!-- div for journal info -->
          <div id='jourInfo'>
            <!-- journal title -->
            <div class="form-group">
              <label for="inputJourName" class="control-label col-xs-2">
                Journal Name</label>
              <div class="col--10">
                <input type="text" class="style-4" id="inputJourName"
                 name="inputJourName" placeholder="Journal Name">
              </div>
            </div>
            <!-- ISBN -->
            <div class="form-group">
              <label for="inputISBN" class="control-label col-xs-2">ISBN</label>
              <div class="col--10">
                <input type="text" class="style-4" id="inputISBN"
                 name="inputISBN" placeholder="ISBN">
              </div>
            </div>
          </div>
          <!-- vol -->
          <div class="form-group">
            <label for="inputVol" class="control-label col-xs-2">Volume</label>
            <div class="col--10">
              <input type="text" class="style-4" id="inputVol" name="inputVol"
              placeholder="Vol(Leave blank if none)">
            </div>
          </div>
          <!-- issue -->
          <div class="form-group">
            <label for="inputIssue" class="control-label col-xs-2">Issue</label>
            <div class="col--10">
              <input type="text" class="style-4" id="inputIssue"
               name="inputIssue"
              placeholder="Issue(Leave blank if none)">
            </div>
          </div>
          <!-- start page -->
          <div class="form-group">
            <label for="inputStartPg" class="control-label col-xs-2">
              Start Page</label>
            <div class="col--10">
              <input type="text" class="style-4" id="inputStartPg"
               name="inputStartPg"
              placeholder="Start Page(Leave blank if none)">
            </div>
          </div>
          <!-- end page -->
          <div class="form-group">
            <label for="inputEndPg" class="control-label col-xs-2">
              End Page</label>
            <div class="col--10">
              <input type="text" class="style-4" id="inputEndPg"
               name="inputEndPg"
              placeholder="End Page(Leave blank if none)">
            </div>
          </div>

          <!-- impact factor -->
          <div class="form-group">
            <label for="inputImpact" class="control-label col-xs-2">
              Impact Factor</label>
            <div class="col--10">
              <input type="text" class="style-4" id="inputImpact"
               name="inputImpact"
              placeholder="Impact Factor">
            </div>
          </div>

          <!-- file upload -->
          <div class="form-group">
            <label for="inputFile" class="control-label col-xs-2">
              PDF file</label>
            <div class="col--10">
              <input type="file" name="inputFile" id="Inputfile">
            </div>
          </div>
          <input type="hidden" name="inputUser" value='<?php echo
           $_SESSION['username']; ?>'>
           <input type="hidden" name="action" value='add'>
          <!-- submit btn -->
          <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php require PROJ_PATH.'/includes/footer.php'; ?>

    <script>
    // radio button toggle
      $(document).ready(function() {
        $('#jourInfo').hide();
        $('#confInfo').hide();
        $('#inputConfRadio').click(function(){
          if ($('#inputConfRadio').is(':checked')) {
            $('#inputJourRadio').prop('checked',false);
            $('#inputJourRadio').val('false');
            $('#jourInfo').hide();
            $('#confInfo').show();
          }
        });
        $('#inputJourRadio').click(function(){
          if ($('#inputJourRadio').is(':checked')) {
            $('#inputConfRadio').prop('checked',false);
            $('#jourInfo').show();
            $('#confInfo').hide();
          }
        });
      });
    </script>
  </body>
</html>
