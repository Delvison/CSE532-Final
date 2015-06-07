<?php

// includes
define('PROJ_PATH', $_SERVER['DOCUMENT_ROOT'].'/CSE532-Final/');
include_once PROJ_PATH.'lib/error_reporting.php';
include_once PROJ_PATH.'lib/db_helper.php';
include_once PROJ_PATH.'config/db_config.php';

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
    $str = '<select id="'.$id.'" name="'.$id.'">';
    while (($line = fgets($read)) !== false)
    {
      $str = $str . '<option value="'.$line.'">'.$line.'</option>';
    }
    $str = $str . '</select>';
    echo $str;
  } else {
    // error has occurred
     debug('error reading countries');
  }
}


/**
* Produce a table of all publications unfiltered
* @author Delvison Castillo
*/
function all_publications_table()
{
  // global variables from config/db_config.php
  global $db_hostname; // mysql database hostname
  global $db_user; // mysql user
  global $db_password; // mysql password
  global $publications_db; // database of publications
  global $publication_tb;
  global $publication_metadata_tb;

  // query for all publications
  // $query = "SELECT * FROM $publication_tb, $publication_metadata_tb WHERE $publication_tb.id = $publication_metadata_tb.id;";
  $query = "SELECT * FROM $publication_metadata_tb;";
  $receive = receive_query($query,$db_hostname,$db_user,$db_password,
            $publications_db);
  $result = $receive->fetch_array();

  var_dump($result);
  if (sizeof($result) > 0 )
  {
    $str = "<table>";
    for($i = 0; $i < sizeof($result)/2; $i++)
    {
      // echo $result[$i]." ";
      debug($result['country']);
    }
    $str = $str . "</table>";
  } else {
    $str = "NO RESULTS";
  }
  echo $str;
}
?>
