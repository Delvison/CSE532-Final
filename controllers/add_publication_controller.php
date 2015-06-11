<?php
/**
* Controller script responsible for handling the addition of publications into
* the database
* @author Delvison Castillo delvisoncastillo@gmail.com
*/

// includes
if (!defined('PROJ_PATH')) define('PROJ_PATH', $_SERVER['DOCUMENT_ROOT'].'/CSE532-Final/');
include_once PROJ_PATH.'lib/functions.php';
include_once PROJ_PATH.'lib/db_helper.php';
include_once PROJ_PATH.'lib/error_reporting.php';
include_once PROJ_PATH.'config/db_config.php';
include_once PROJ_PATH.'models/publication_model.php';

// get params
$artTitle = $_POST['inputArtTitle'];
$abstract = $_POST['inputAbstract'];
$pubDate = $_POST['inputPubDate'];
$authors = $_POST['inputAuthors']; // multiple
$country = $_POST['inputCountry'];
$user = $_POST['inputUser'];

// upload file
$file_path = upload_file($user);

// get authors
$authors_array = explode(",",$authors);

if ( add_publication($artTitle, $abstract, $pubDate, $user) &&
    !is_null($file_path) )
{
  add_publication_metadata(NULL,NULL,NULL,NULL,NULL,$country,$file_path);
  add_publication_authors($authors_array);
  // TODO: redirect appropriately
  echo 'success';
  header("Location: ../views/view_all.php?status=success");
} else {
  debug("error adding publication");
}



?>
