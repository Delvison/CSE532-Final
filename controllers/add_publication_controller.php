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

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

try {
  // get params
  $artTitle = $_POST['inputArtTitle'];
  $abstract = $_POST['inputAbstract'];
  $pubDate = $_POST['inputPubDate'];
  $authors = $_POST['inputAuthors']; // multiple
  $country = $_POST['inputCountry'];
  $user = $_POST['inputUser'];
  $vol = '-';
  $issue = '-';
  $startPg = '-';
  $endPg = '-';
  $impact_factor = '-';

  if (isset($_POST['inputVol'])) $vol = $_POST['inputVol'];
  if (isset($_POST['inputIssue'])) $issue = $_POST['inputIssue'];
  if (isset($_POST['inputStartPg'])) $startPg = $_POST['inputStartPg'];
  if (isset($_POST['inputEndPg'])) $endPg = $_POST['inputEndPg'];
  if (isset($_POST['inputImpact'])) $impact_factor = $_POST['inputImpact'];

  // upload file
  $file_path = upload_file($user);

  // get authors
  $authors_array = explode(",",$authors);

  if ($_POST['action'] == 'add')
  {
    //if publication was added and file was uploaded
    if ( add_publication($artTitle, $abstract, $pubDate, $user)
        && !is_null($file_path) )
    {
      // get publication id
      $pub_id = get_publication_id($artTitle,$pubDate);

      echo 'id: '.$pub_id;

      // add metadata
      add_publication_metadata($vol,$issue,$startPg,$endPg,$impact_factor,
      $country,$file_path);
      // add authors
      add_publication_authors($pub_id,$authors_array);
      // check if a conference or journal
      if (isset($_POST['inputConfRadio']) )
      {
        $confName = $_POST['inputConfName'];
        $confDate = $_POST['inputConfDate'];
        add_conference($pub_id,$confName,$confDate);
      } else {
        $jourName = $_POST['inputJourName'];
        $isbn = $POST['inputISBN'];
        add_journal($pub_id,$jourName,$isbn);
      }
      header("Location: ../views/view_all.php?status=success");
    } else {
      echo("something failed");
      debug("error adding publication");
    }
  }

  if ($_POST['action'] == 'edit')
  {
    echo 'edit';
  }
} catch (Exception $e) {
  //TODO: handle errors correctly
  debug($e->getMessage());
}



?>
