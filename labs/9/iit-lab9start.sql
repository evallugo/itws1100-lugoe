-- Drop tables if they already exist to avoid errors
DROP TABLE IF EXISTS movie_actors;
DROP TABLE IF EXISTS movies;
DROP TABLE IF EXISTS actors;

-- Create the 'actors' table to store character names and birthdates
CREATE TABLE actors (
    actor_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    dob DATE NOT NULL
);

-- Insert sample actors
-- At least five actors are inserted; note that the first three have birthdates prior to 1960 as required.
INSERT INTO actors (first_name, last_name, dob) VALUES
('Marlon', 'Brando', '1944-04-03'),
('Audrey', 'Hepburn', '1929-05-04'),
('James', 'Dean', '1931-02-08'),
('Tom', 'Hanks', '1956-07-09'),
('Natalie', 'Portman', '1981-06-09');

-- Create the 'movies' table to store movie details
CREATE TABLE movies (
    movie_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    release_year INT NOT NULL
);

-- Insert sample movies
INSERT INTO movies (title, release_year) VALUES
('The Godfather', 1972),
('Casablanca', 1942);

-- Create the 'movie_actors' relationship table to associate movies with actors
CREATE TABLE movie_actors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT NOT NULL,
    actor_id INT NOT NULL,
    FOREIGN KEY (movie_id) REFERENCES movies(movie_id),
    FOREIGN KEY (actor_id) REFERENCES actors(actor_id)
);

-- Insert sample relationships between movies and actors
-- Example: Marlon Brando (actor_id 1) starred in The Godfather (movie_id 1)
INSERT INTO movie_actors (movie_id, actor_id) VALUES
(1, 1),
(2, 2);  -- For example: Audrey Hepburn (actor_id 2) in Casablanca (movie_id 2)
