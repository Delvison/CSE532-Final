<!-- NAVBAR -->
<div class="page">
  <div class="navbar">
    <div class="navbar-inner">
      <a class="brand" href="#">SKAP</a>
      <ul class="nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="add_publication.php">Add Publication</a></li>
        <li><a href="view_all.php">View Publications</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
        if (!isset($_SESSION['username']))
        {
          echo '<li><a href="login.php">Login</a></li>';
        } else{
          echo '<li><div style="margin-top:10px"><div style="padding-right:10px">'.$_SESSION['username']."</div></li> ";
          echo '  <li><a href="../controllers/login_controller.php'.
          '?logout=true">Logout</a></div></li>';
        }
        ?>
      </ul>
    </div>
  </div>
</div>
<!-- NAVBAR END -->
