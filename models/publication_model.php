<?php

// includes
if (!defined('PROJ_PATH')) define('PROJ_PATH', $_SERVER['DOCUMENT_ROOT'].'/CSE532-Final/');
include_once PROJ_PATH.'lib/functions.php';
include_once PROJ_PATH.'lib/db_helper.php';
include_once PROJ_PATH.'lib/error_reporting.php';
include_once PROJ_PATH.'config/db_config.php';
include_once PROJ_PATH.'models/publication_model.php';


function add_publication($title, $abstract, $pubDate, $user)
{
  // global variables from config/db_config.php
  global $db_hostname; // mysql database hostname
  global $db_user; // mysql user
  global $db_password; // mysql password
  global $publications_db; // database of publications
  global $publication_tb;

  $query = "INSERT into $publication_tb (id, title, abstract, publication_date, user_posted) VALUES".
              "(NULL,'$title','$abstract','$pubDate','$user');";
  // called from lib/db_helper.php
  return send_query($query, $db_hostname, $db_user, $db_password,
  $publications_db);
}

function add_publication_metadata($vol,$issue,$start_pg,$end_pg,
$impact_factor,$country, $filepath)
{
  // global variables from config/db_config.php
  global $db_hostname; // mysql database hostname
  global $db_user; // mysql user
  global $db_password; // mysql password
  global $publications_db; // database of publications
  global $publication_metadata_tb;

  // defaults
  if (is_null($vol)) $vol = 'NULL';
  if (is_null($issue)) $issue = 'NULL';
  if (is_null($start_pg)) $start_pg = 0;
  if (is_null($end_pg)) $end_pg = 0;
  if (is_null($impact_factor)) $impact_factor = 0.0;
  if (is_null($country)) $country = 'NULL';

  $query = "INSERT into $publication_metadata_tb (id,vol,issue,start_pg,end_pg, impact_factor,country, file_path) VALUES ".
              "(NULL,$vol,$issue,$start_pg,$end_pg,$impact_factor,'$country','$filepath');";
  // called from lib/db_helper.php
  return send_query($query, $db_hostname, $db_user, $db_password,
  $publications_db);
}

function add_publication_authors($pubId,$authors)
{
  // global variables from config/db_config.php
  global $db_hostname; // mysql database hostname
  global $db_user; // mysql user
  global $db_password; // mysql password
  global $publications_db; // database of publications
  global $author_tb;
  global $is_author_of_tb;

  $query = "";
  foreach($authors as $author)
  {
    $query = "INSERT IGNORE into $author_tb (name) VALUES ('$author');";
    send_query($query, $db_hostname, $db_user, $db_password,
    $publications_db);
    $query = "INSERT into $is_author_of_tb (id,author,publication) VALUES ".
              "(NULL,'$author','$pubId');";
    send_query($query, $db_hostname, $db_user, $db_password,
    $publications_db);
  }
}

function add_conference($pubId,$confName,$confDate)
{
  global $db_hostname; // mysql database hostname
  global $db_user; // mysql user
  global $db_password; // mysql password
  global $publications_db; // database of publications
  global $is_category_tb;
  global $conference_tb;

  if (is_null($confName)) $confName = 'NULL';
  if (is_null($confDate)) $confDate = 'NULL';

  $query = "INSERT IGNORE into $conference_tb (name,start_date) VALUES ".
            "('$confName','$confDate');";
  send_query($query,$db_hostname,$db_user,$db_password,$publications_db);
  $query = "INSERT into $is_category_tb (publication,journal,conference) ".
          "VALUES ('$pubId',NULL,'$confName');";
  send_query($query,$db_hostname,$db_user,$db_password,$publications_db);
}

function add_journal($pubId,$jourName,$isbn)
{
  global $db_hostname; // mysql database hostname
  global $db_user; // mysql user
  global $db_password; // mysql password
  global $publications_db; // database of publications
  global $is_category_tb;
  global $journal_tb;

  if (is_null($jourName)) $jourName = 'NULL';
  if (is_null($isbn)) $isbn = 'NULL';

  $query = "INSERT IGNORE into $is_category_tb (publication,journal,conference) ".
          "VALUES ('$pubId','$jourName',NULL);";
  $query .= "INSERT into $journal_tb (name,category,isbn) VALUES ".
            "('$jourName',NULL,'$isbn');";

  send_query($query,$db_hostname,$db_user,$db_password,$publications_db);
}

function get_publication_id($title,$pubDate)
{
  // global variables from config/db_config.php
  global $db_hostname; // mysql database hostname
  global $db_user; // mysql user
  global $db_password; // mysql password
  global $publications_db; // database of publications
  global $publication_tb;

  $query = "SELECT id from $publication_tb WHERE title='$title' and date_published='$pubDate';";
  $result = receive_query($query, $db_hostname,$db_user,
            $db_password,$publications_db)->fetch_array();
  return $result[0];
}

?>
