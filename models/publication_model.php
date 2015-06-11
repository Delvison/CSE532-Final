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

function add_publication_authors($authors,$article_title)
{

}

?>
