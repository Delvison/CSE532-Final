CREATE DATABASE IF NOT EXISTS publications;
USE publications;

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

-- relates author entities with a publication entity
CREATE TABLE Is_author_of(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    author VARCHAR(100) NOT NULL,
    publication INT NOT NULL
);

    ALTER TABLE Is_author_of
      /* foreign key for author entities */
      ADD CONSTRAINT FK_author
      FOREIGN KEY (author) REFERENCES Author(name)
      ON DELETE CASCADE
      ON UPDATE CASCADE,
      /* foreign key for publication entities */
      ADD CONSTRAINT FK_publication_for_author
      FOREIGN KEY (publication) REFERENCES Publication(id);

-- relates a publication with a category of either journal || conference
CREATE TABLE Is_category(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  publication INT NOT NULL,
  journal VARCHAR(100),
  conference VARCHAR(100)
);

    ALTER TABLE Is_category
      /* foreign key for publication entities */
      ADD CONSTRAINT FK_publication_for_category
      FOREIGN KEY (publication) REFERENCES Publication(id)
    	ON DELETE CASCADE
    	ON UPDATE CASCADE,
      /* foreign key for journal entities */
      ADD CONSTRAINT FK_journal
      FOREIGN KEY (journal) REFERENCES Journal(name)
    	ON DELETE CASCADE
    	ON UPDATE CASCADE,
      /* foreign key for conference entities*/
      ADD CONSTRAINT fk_conference
      FOREIGN KEY (conference) REFERENCES Conference(name)
    	ON DELETE CASCADE
    	ON UPDATE CASCADE;
