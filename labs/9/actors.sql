-- create the tables for our movies
CREATE TABLE `actors` (
   `actorid` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `firstNames` varchar(100) NOT NULL,
   `lastName` varchar(100) NOT NULL,
   `dob` char(10) DEFAULT NULL,
   PRIMARY KEY (`actorid`)
);
-- insert data into the tables
INSERT INTO actors
VALUES 
   (1, "Jennifer", "Lawrence", "1949-06-22"),
   (2, "Tom", "Cruise", "1943-08-17"),
   (3, "Jennifer", "Lopez", "1940-04-25"),
   (4, "Olivia", "Rodrigo", "1937-04-22"),
   (5, "Paul", "Walker", "1937-06-01");

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