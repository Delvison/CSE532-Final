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
  if (is_null($vol)) $vol = '-';
  if (is_null($issue)) $issue = '-';
  if (is_null($start_pg)) $start_pg = 0;
  if (is_null($end_pg)) $end_pg = 0;
  if (is_null($impact_factor)) $impact_factor = 0.0;
  if (is_null($country)) $country = '-';

  $query = "INSERT into $publication_metadata_tb (id,vol,issue,start_pg,end_pg, impact_factor,country, file_path) VALUES ".
              "(NULL,'$vol','$issue','$start_pg','$end_pg','$impact_factor','$country','$filepath');";
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

  $query = "INSERT into $journal_tb (name,category,isbn) VALUES ".
            "('$jourName',NULL,'$isbn');";
  send_query($query,$db_hostname,$db_user,$db_password,$publications_db);
  $query = "INSERT IGNORE into $is_category_tb (publication,journal,conference) ".
          "VALUES ('$pubId','$jourName',NULL);";
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

  $query = "SELECT id from $publication_tb WHERE title='$title' and publication_date='$pubDate';";
  $result = receive_query($query, $db_hostname,$db_user,
            $db_password,$publications_db)->fetch_array();
  return $result[0];
}

function get_publication($id)
{
  // global variables from config/db_config.php
  global $db_hostname; // mysql database hostname
  global $db_user; // mysql user
  global $db_password; // mysql password
  global $publications_db; // database of publications
  global $publication_tb;
  global $publication_metadata_tb;
  global $is_author_of_tb;
  global $is_category_tb;
  global $journal_tb;
  global $conference_tb;

  // query for all publications
  $query = "SELECT ".
  "$publication_tb.id,".
  "$publication_tb.title,".
  "$publication_tb.abstract,".
  "$publication_tb.publication_date,".
  "$publication_tb.user_posted, ".
  "$publication_metadata_tb.vol,".
  "$publication_metadata_tb.issue,".
  "$publication_metadata_tb.start_pg,".
  "$publication_metadata_tb.end_pg,".
  "$publication_metadata_tb.impact_factor,".
  "$publication_metadata_tb.country,".
  "$publication_metadata_tb.file_path,".
  "$is_author_of_tb.author,".
  "$is_category_tb.journal,".
  "$is_category_tb.conference ".
  "FROM $publication_tb, $publication_metadata_tb, $is_author_of_tb, $is_category_tb".
  " WHERE $id = $publication_metadata_tb.id".
  " AND $id = $is_author_of_tb.publication".
  " AND $id = $is_category_tb.publication";

  //echo $query;
  $receive = receive_query($query,$db_hostname,$db_user,$db_password,
             $publications_db);
  $str = '';
  $id = '';
  $title = '';
  $abstract = '';
  $pub_date = '';
  $user_posted = '';
  $vol = '';
  $issue = '';
  $start_pg = '';
  $end_pg = '';
  $impact_factor = '';
  $country = '';
  $file_path = '';
  $journal = '';
  $conference = '';
  $authors = '';
  $authors_array = array();
  while ($result = $receive->fetch_assoc())
  {
    foreach ($result as $val)
    {
      switch($val)
      {
        case $result['id']: $id = $val; break;
        case $result['title']: $title = $val; break;
        case $result['abstract']: $abstract = $val; break;
        case $result['publication_date']: $pub_date = $val; break;
        case $result['user_posted']: $user_posted = $val; break;
        case $result['vol']: $vol = $val; break;
        case $result['issue']: $issue = $val; break;
        case $result['start_pg']: $start_pg = $val; break;
        case $result['end_pg']: $end_pg = $val; break;
        case $result['impact_factor']: $impact_factor = $val; break;
        case $result['country']: $country = $val; break;
        case $result['file_path']: $file_path = $val; break;
        case $result['conference']: $conference = $val; break;
        case $result['journal']: $journal = $val; break;
        case $result['author']: array_push($authors_array, $val); break;
      }
    }
  }

  $authors_array = array_unique($authors_array);
  foreach($authors_array as $a){ $authors .= $a . ','; }
  $authors = substr($authors,0,-1);

  // produce edit link if publication belongs to the user
  if (isset($_SESSION['username']) && $user_posted == $_SESSION['username'])
  {
    $str .= "<form id='edit' action='edit_publication.php' method='POST'>";
    $str .= "<input type='hidden' name='inputArtTitle' value='$title'>";
    $str .= "<input type='hidden' name='inputAbstract' value='$abstract'>";
    $str .= "<input type='hidden' name='inputPubDate' value='$pub_date'>";
    $str .= "<input type='hidden' name='inputAuthors' value='$authors'>";
    $str .= "<input type='hidden' name='inputAuthors' value='$authors'>";
    $str .= "<input type='hidden' name='inputCountry' value='$country'>";
    $str .= "<input type='hidden' name='inputConfName' value='$conference'>";
    $str .= "<input type='hidden' name='inputConfDate' value='$conference'>"; //fix
    $str .= "<input type='hidden' name='inputJourName' value='$journal'>";
    $str .= "<input type='hidden' name='inputISBN' value='$journal'>"; // fix
    $str .= "<input type='hidden' name='inputVol' value='$vol'>";
    $str .= "<input type='hidden' name='inputIssue' value='$issue'>";
    $str .= "<input type='hidden' name='inputStartPg' value='$start_pg'>";
    $str .= "<input type='hidden' name='inputEndPg' value='$end_pg'>";
    $str .= "<input type='hidden' name='inputImpact' value='$impact_factor'>";
    $str .= "<input type='hidden' name='inputFile' value='$file_path'>";
    $str .= "<input type='hidden' name='inputUser' value='$user_posted'>";
    $str .= "<a href=\"edit_publication.php?id=$id\" onclick=\"$(this).closest('form').submit(); return false;\">Edit Publication</a>";
    $str .= "</form>";
  }

  $str .= "<h3>Title:</h3> $title <a href='../$file_path'> PDF</a></br>";
  $str .= "<h3>Authors:</h3>$authors</br>";
  $str .= "<h3>Abstract:</h3> $abstract</br>";
  $str .= "<h3>Date Published:</h3> $pub_date</br>";
  $str .= "<h3>User Posted:</h3> $user_posted</br>";
  $str .= "<h3>Vol:</h3> $vol</br>";
  $str .= "<h3>Issue:</h3> $issue</br>";
  $str .= "<h3>Pages:</h3> $start_pg - $end_pg</br>";
  $str .= "<h3>Impact Factor:</h3> $impact_factor</br>";
  $str .= "<h3>Country:</h3> $country</br>";
  if (!is_null($conference)) $str .= "<h3>Conference:</h3> $conference</br>";
  if (!is_null($journal)) $str .= "<h3>Journal:</h3> $journal</br>";

  echo $str;
}

?>
