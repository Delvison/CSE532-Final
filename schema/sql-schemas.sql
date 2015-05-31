CREATE DATABASE publications;
USE publications;

-- CREATE ENTITIES ============================================================
CREATE TABLE Author (name VARCHAR(100) NOT NULL PRIMARY KEY);

CREATE TABLE Publication (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(100) NOT NULL,
  abstract TEXT NOT NULL,
  publication_date DATE NOT NULL
);

CREATE TABLE User (username VARCHAR(30) NOT NULL PRIMARY KEY,
  email VARCHAR(40) NOT NULL,
  salt VARCHAR(8) NOT NULL, /* salt used for hashing password */
  password VARCHAR(128) NOT NULL, /* SHA-128 hashed password */
  is_admin BOOLEAN NOT NULL, /* indicates whether user is an admin */
  date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Publication_metadata (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  vol VARCHAR(10),
  issue VARCHAR(10),
  start_pg INT,
  end_pg INT,
  impact_factor FLOAT
);

CREATE TABLE Country (name VARCHAR(30) NOT NULL PRIMARY KEY);

CREATE TABLE Journal(name VARCHAR(100) NOT NULL PRIMARY KEY,
  category VARCHAR(10),
  isbn VARCHAR(13)
);

CREATE TABLE Conference(name VARCHAR(100) NOT NULL PRIMARY KEY,
  start_date DATE NOT NULL
);

-- CREATE RELATIONSHIPS =======================================================

-- relates author entities with a publication entity
CREATE TABLE Is_author_of(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT);

ALTER TABLE Is_author_of
	ADD COLUMN fk_author VARCHAR(100) NOT NULL,
	ADD FOREIGN KEY fk_author(fk_author)
	REFERENCES Author(name)
	ON DELETE NO ACTION
	ON UPDATE CASCADE;

ALTER TABLE Is_author_of
  ADD COLUMN fk_publication INT NOT NULL,
	ADD FOREIGN KEY fk_publication(fk_publication)
	REFERENCES Publication(id)
	ON DELETE NO ACTION
	ON UPDATE CASCADE;

-- relates a publication with a category of either journal || conference
CREATE TABLE Is_category(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT);

ALTER TABLE Is_category
  ADD COLUMN fk_publication INT NOT NULL,
	ADD FOREIGN KEY fk_publication(fk_publication)
	REFERENCES Publication(id)
	ON DELETE NO ACTION
	ON UPDATE CASCADE;

ALTER TABLE Is_category
  ADD COLUMN fk_journal VARCHAR(100) NOT NULL,
	ADD FOREIGN KEY fk_journal(fk_journal)
	REFERENCES Journal(name)
	ON DELETE NO ACTION
	ON UPDATE CASCADE;

ALTER TABLE Is_category
  ADD COLUMN fk_conference VARCHAR(100) NOT NULL,
	ADD FOREIGN KEY fk_conference(fk_conference)
	REFERENCES Conference(name)
	ON DELETE NO ACTION
	ON UPDATE CASCADE;
