<?php

// includes
define('PROJ_PATH', $_SERVER['DOCUMENT_ROOT'].'/CSE532-Final/');
include_once PROJ_PATH.'lib/error_reporting.php';

/**
* This function is responsible for handling errors. Redirects to next
* location after a defined wait time
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function error($error, $location, $redirect, $seconds)
{
  echo "<br/>";
  echo "<h1>".$error."</h1>";
  if ($redirect)  {
    header("Refresh: $seconds; URL='$location'");
  }
  die();
}

/**
* Takes in a target directory and a filename and ensures that the file to be
* inserted in the directory has a unique filename.
* @param String $target_dir Target directory for file
* @param String $filename Name of file to be inserted to target directory.
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function create_unique_filename($target_dir,$filename)
{
  $now = time();
  while ( file_exists($result = $target_dir . $now.'-'.$filename))
  {
    $now++;
  }
  return $result;
}

/**
* This function checks whether the password contains any alphabetic
*	characters and numeric values
* @author Nuwan
*/
function check_pwd($str)
{
  if ( strlen($str) >= 8 &&
  strlen($str) <= 30 &&
  preg_match('/[A-Z]/',$str ) &&
  preg_match('#[0-9]#',$str) &&
  preg_match('/[a-z]/',$str ))
  {
    return TRUE;
  }
  else {
    return FALSE;
  }
}

/**
* This function checks whether a given username is greater than 8
* characters and less than 30.
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function check_username($str)
{
  if ( strlen($str) >= 4 &&
  strlen($str) <= 30)
  {
    return TRUE;
  } else {
    return FALSE;
  }
}

/**
* This function checks whether a given email is valid.
* @author Delvison Castillo delvisoncastillo@gmail.com
*/
function check_email($str)
{
  if (filter_var($str, FILTER_VALIDATE_EMAIL)) {
    return TRUE;
  } else {
    return FALSE;
  }
}

/**
* Produces an html dropdown list
* @param String $filename path of file to be read
* @param String $id html id element name
* @author Delvison Castillo
*/
function produce_dropdown($filename,$id)
{
  $read = fopen($filename,"r");
  if ($read)
  {
    $str = '<select id="'.$id.'>';
    while (($line = fgets($read)) !== false)
    {
      $str = $str . '<option value="'.$line.'">'.$line.'</option>';
    }
    $str = $str . '</select>';
    echo $str;
  } else {
    // error has occurred
     debug('error');
  }
}

?>
