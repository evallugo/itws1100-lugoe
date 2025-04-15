-- Create the relationship table
CREATE TABLE relationship (
    movieid INT,
    actorid INT,
    PRIMARY KEY (movieid, actorid),
    FOREIGN KEY (movieid) REFERENCES movies(movieid),
    FOREIGN KEY (actorid) REFERENCES actors(actorid)
); 