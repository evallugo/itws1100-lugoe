-- Create the actors table
CREATE TABLE `actors` (
   `actorid` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `first_names` varchar(100) NOT NULL,
   `last_name` varchar(100) NOT NULL,
   `dob` date DEFAULT NULL,
   PRIMARY KEY (`actorid`)
);

-- Create the relationship table between movies and actors
CREATE TABLE `movie_actors` (
   `movieid` int(10) unsigned NOT NULL,
   `actorid` int(10) unsigned NOT NULL,
   PRIMARY KEY (`movieid`, `actorid`),
   FOREIGN KEY (`movieid`) REFERENCES `movies` (`movieid`) ON DELETE CASCADE,
   FOREIGN KEY (`actorid`) REFERENCES `actors` (`actorid`) ON DELETE CASCADE
); 