-- Create the movie_actors relationship table
CREATE TABLE `movie_actors` (
   `movieid` int(10) unsigned NOT NULL,
   `actorid` int(10) unsigned NOT NULL,
   PRIMARY KEY (`movieid`, `actorid`),
   FOREIGN KEY (`movieid`) REFERENCES movies(`movieid`),
   FOREIGN KEY (`actorid`) REFERENCES actors(`actorid`)
);

-- Insert some sample relationships
INSERT INTO movie_actors (`movieid`, `actorid`) VALUES
(1, 5),  -- Leonardo DiCaprio in Elizabeth
(2, 6),  -- Scarlett Johansson in Black Widow
(3, 4),  -- Tom Hanks in Oh Brother Where Art Thou?
(4, 5),  -- Leonardo DiCaprio in Lord of the Rings
(5, 7);  -- Emma Stone in Up in the Air 