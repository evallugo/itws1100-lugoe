-- create the tables for our movies
CREATE TABLE `movies` (
   `movieid` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `title` varchar(100) NOT NULL,
   `year` char(4) DEFAULT NULL,
   PRIMARY KEY (`movieid`)
);

-- insert data into the tables
INSERT INTO movies
VALUES (1, "Elizabeth", "1998"),
   (2, "Black Widow", "2021"),
   (3, "Oh Brother Where Art Thou?", "2000"),
   (
      4,
      "The Lord of the Rings: The Fellowship of the Ring",
      "2001"
   ),
   (5, "Up in the Air", "2009");

-- create the table for our actors
CREATE TABLE actors (
    actorid INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstNames VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    dob DATE NOT NULL
);

-- insert data into the actors table
INSERT INTO actors
VALUES 
   (NULL, "Jennifer", "Lopez", "1969-07-24"),
   (NULL, "Brad", "Pitt", "1963-12-18"),
   (NULL, "Tom", "Cruise", "1962-07-03"),
   (NULL, "Tom", "Hanks", "1956-07-09"),
   (NULL, "Will", "Smith", "1968-09-25");
