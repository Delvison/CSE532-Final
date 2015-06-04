<?php
/**
* Controller script responsible for handling user login and the creation of a
* new user.
* @author Delvison Castillo delvisoncastillo@gmail.com
*/

// includes
define('PROJ_PATH', $_SERVER['DOCUMENT_ROOT'].'/CSE532-Final/');
include PROJ_PATH.'models/login_model.php';
include_once PROJ_PATH.'lib/functions.php';

// get action
$action = $_POST['action'];

if ($action == 'create_user')
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  check_pwd($password)
  or error("Invalid password.",
  "../create_user.php?error=invalid_passwd",TRUE,1);
  check_username($username)
  or error("Invalid username.",
  "../create_user.php?error=invalid_username",TRUE,1);
  check_email($email)
  or error("Invalid email.",
  "../create_user.php?error=invalid_email&username="
  .$username."&email=".$email,TRUE,1);
  date_default_timezone_set('Asia/Seoul');
  $date = date("Y-m-d H:i:s");
  // called from models/members_model.php
  if (create_user($username, $password, $email, $date) )
  {
    header("Location: ../login.php");
    die();
  } else {
    header("Location: ../create_user.php?error=failed&username=".
    $username."&email=".$email);
    die();
  }
}

if ($action == 'login')
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  if ( login_user($username, $password) )
  {
    // start a new session
    session_id('mySessionID');
    session_start();
    // save username to the session
    $_SESSION['username'] = $username;
    header("Location: ../index.php");
    die();
  } else {
    header("Location: ../login.php?error=inc_pass");
    die();
  }
}

if ($_GET['logout'] != NULL)
{
  logout();
}
