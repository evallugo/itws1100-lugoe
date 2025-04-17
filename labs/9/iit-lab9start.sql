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

-- insert data into the actors table
INSERT INTO actors (first_name, last_name, dob)
VALUES 
   ("Eddie", "Murphy", "1955-04-03"),
   ("Danny", "DeVito", "1944-11-17"),
   ("Tom", "Hanks", "1956-07-09"),
   ("Leonardo", "DiCaprio", "1958-11-11"),
   ("Morgan", "Freeman", "1937-06-01");

   INSERT INTO `relationship` (`movieid`, `actorid`) VALUES
(8,1),
()

