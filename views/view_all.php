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
    <div class="center">
      <input type="text" class="span5 search-query" placeholder="Filter..."
      name="searchInput" id="searchInput">
    </input>
      <!-- <button type="submit" class="btn"><i class="icon-search"></i></button> -->
    </div>
    <div>
      <?php all_publications_table(); ?>
      <?php require PROJ_PATH.'/includes/footer.php'; ?>
    </div>
  </body>
    <script>
      // function for table filtering
      $(document).ready(function()
      {
        $("#searchInput").keyup(function ()
        {
          //split the current value of searchInput
          var data = this.value.split(" ");
          //create a jquery object of the rows
          var jo = $(".fbody").find("tr");
          if (this.value == "") {
            jo.show();
            return;
          }
          //hide all the rows
          jo.hide();

          //Recusively filter the jquery object to get results.
          jo.filter(function (i, v) {
            var $t = $(this);
            for (var d = 0; d < data.length; ++d)
            {
              if ($t.is( ":contains('" + data[d] + "')") ) {
                return true;
              }
            }
            return false;
        })
        //show the rows that match.
        .show();
        }).focus(function () {
          this.value = "";
          $(this).css({
            "color": "black"
          });
          $(this).unbind('focus');
        }).css({ "color": "#C0C0C0" });

        $("#searchInput").focusout(function(){
          if ($(this).val() == '') {
            $(this).val('Filter...');
          }
          $(this).css({"color": "#C0C0C0" });
        })
        .focusin(function(){
          if ($(this).val() == 'Filter...'){
            $(this).val('');
          }
          $(this).css({"color": "black" });
        });
      });
    </script>
</html>
