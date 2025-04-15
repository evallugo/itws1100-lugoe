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

-- Create the actors table
CREATE TABLE `actors` (
   `actorid` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `first_names` varchar(100) NOT NULL,
   `last_name` varchar(100) NOT NULL,
   `dob` date DEFAULT NULL,
   PRIMARY KEY (`actorid`)
);

-- Insert sample actors into the actors table
INSERT INTO actors (`first_names`, `last_name`, `dob`) VALUES
   ('Tom', 'Hanks', '1956-07-09'),
   ('Meryl', 'Streep', '1949-06-22'),
   ('Leonardo', 'DiCaprio', '1974-11-11'),
   ('Scarlett', 'Johansson', '1984-11-22'),
   ('Morgan', 'Freeman', '1937-06-01'),
   ('Emma', 'Watson', '1990-04-15'),
   ('Brad', 'Pitt', '1963-12-18');

-- Create the movie_actor relationship table
CREATE TABLE `movie_actor` (
   `movie_actor_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `movieid` int(10) unsigned NOT NULL,
   `actorid` int(10) unsigned NOT NULL,
   PRIMARY KEY (`movie_actor_id`),
   KEY `movieid` (`movieid`),
   KEY `actorid` (`actorid`),
   CONSTRAINT `movie_actor_ibfk_1` FOREIGN KEY (`movieid`) REFERENCES `movies` (`movieid`) ON DELETE CASCADE,
   CONSTRAINT `movie_actor_ibfk_2` FOREIGN KEY (`actorid`) REFERENCES `actors` (`actorid`) ON DELETE CASCADE
);

-- Insert sample relationships between movies and actors
INSERT INTO movie_actor (`movieid`, `actorid`) VALUES
   (1, 2),  -- Meryl Streep in Elizabeth
   (2, 4),  -- Scarlett Johansson in Black Widow
   (3, 1),  -- Tom Hanks in Oh Brother Where Art Thou?
   (4, 5),  -- Morgan Freeman in The Lord of the Rings
   (5, 3);  -- Leonardo DiCaprio in Up in the Air