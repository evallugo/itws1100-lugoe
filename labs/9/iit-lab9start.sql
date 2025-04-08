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

-- create the actors table
CREATE TABLE `actors` (
   `actorid` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `first_names` varchar(100) NOT NULL,
   `last_name` varchar(100) NOT NULL,
   `dob` date NOT NULL,
   PRIMARY KEY (`actorid`)
);

-- insert sample actors (including some born before 1960)
INSERT INTO actors (`first_names`, `last_name`, `dob`) VALUES
('Marlon', 'Brando', '1924-04-03'),
('Al', 'Pacino', '1940-04-25'),
('Robert', 'De Niro', '1943-08-17'),
('Tom', 'Hanks', '1956-07-09'),
('Leonardo', 'DiCaprio', '1974-11-11'),
('Scarlett', 'Johansson', '1984-11-22'),
('Emma', 'Stone', '1988-11-06');

-- create the movie_actors relationship table
CREATE TABLE `movie_actors` (
   `movieid` int(10) unsigned NOT NULL,
   `actorid` int(10) unsigned NOT NULL,
   PRIMARY KEY (`movieid`, `actorid`),
   FOREIGN KEY (`movieid`) REFERENCES movies(`movieid`),
   FOREIGN KEY (`actorid`) REFERENCES actors(`actorid`)
);

-- insert sample relationships
INSERT INTO movie_actors (`movieid`, `actorid`) VALUES
(1, 5),  -- Leonardo DiCaprio in Elizabeth
(2, 6),  -- Scarlett Johansson in Black Widow
(3, 4),  -- Tom Hanks in Oh Brother Where Art Thou?
(4, 5),  -- Leonardo DiCaprio in Lord of the Rings
(5, 7);  -- Emma Stone in Up in the Air