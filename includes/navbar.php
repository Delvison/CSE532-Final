<?php
// TODO: Make all links absolute
?>

<!-- NAVBAR -->
<div class="page">
  <nav role="navigation" class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="index.php" class="navbar-brand">EXAMPLE</a>
      <div style="margin-top:6px; margin-left:10px; margin-right: 10px">
      </div>
    </div>
    <!-- Collection of nav links and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="view_ideas.php">Publications</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <?php
        if (!isset($_SESSION['username']))
        {
          echo '<li><a href="login.php">Login</a></li>';
        } else{
          echo '<li><div style="margin-top:10px"><div style="padding-right:10px">'.$_SESSION['username']."</div></li> ";
          echo '  <li><a href="controllers/login_controller.php'.
          '?logout=true">Logout</a></div></li>';
        }
        ?>
      </ul>
    </div>
  </nav>
</div>
<!-- NAVBAR END -->
