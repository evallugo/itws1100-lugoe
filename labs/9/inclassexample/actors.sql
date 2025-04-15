-- create the tables for our movies
CREATE TABLE actors (
    actorid INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstNames VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    dob DATE NOT NULL
);

-- insert data into the tables
INSERT INTO actors
VALUES 
   (NULL, "Jennifer", "Lopez", "1969-07-24"),
   (NULL, "Brad", "Pitt", "1953-12-18"),
   (NULL, "Tom", "Cruise", "1942-07-03"),
   (NULL, "Tom", "Hanks", "1956-07-09"),
   (NULL, "Will", "Smith", "1968-09-25");

CREATE TABLE `relationship` (
    `actorid` int(10) unsigned NOT NULL,
    `movieid` int(10) unsigned NOT NULL,
    PRIMARY KEY (`actorid`, `movieid`),
    FOREIGN KEY (`actorid`) REFERENCES `actors` (`actorid`),
    FOREIGN KEY (`movieid`) REFERENCES `movies` (`movieid`)
);

INSERT INTO `relationship`
VALUES (1, 1),
       (2, 2),
       (3, 3),
       (4, 4),
       (5, 5);