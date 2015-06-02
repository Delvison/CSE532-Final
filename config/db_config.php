<?php
  /**
  * this file holds the configuration parameters for the mysql database
  * @author Delvison Castillo delvisoncastillo@gmail.com
  */

  // define('DB_HOSTNAME', '54.149.232.134');
  // define('DB_USER', 'suny');
  // define('DB_PASSWORD', 'suny');
  /* PARAMETERS */
  $db_hostname = "127.0.0.1";
	$db_user= "root";
	$db_password = "sunyk";

  /* DATABASES */
  $members_db = "secure_login";
  $idea_db = "idea_db";
  $publications_db = "publications_db";

  /* TABLES */
  $author_tb = "Author";
  $publication_tb = "Publication";
  $user_tb = "User";
  $publication_metadata_tb = "Publication_metadata";
  $country_tb = "Country";
  $journal_tb = "Journal";
  $conference_tb = "Conference";
  $is_author_of_tb = "Is_author_of";
  $is_category_tb = "Is_category";

?>
