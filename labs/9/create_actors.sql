-- Create the actors table
CREATE TABLE `actors` (
   `actorid` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `first_names` varchar(100) NOT NULL,
   `last_name` varchar(100) NOT NULL,
   `dob` date NOT NULL,
   PRIMARY KEY (`actorid`)
);

-- Insert some sample actors (including some born before 1960)
INSERT INTO actors (`first_names`, `last_name`, `dob`) VALUES
('Marlon', 'Brando', '1924-04-03'),
('Al', 'Pacino', '1940-04-25'),
('Robert', 'De Niro', '1943-08-17'),
('Tom', 'Hanks', '1956-07-09'),
('Leonardo', 'DiCaprio', '1974-11-11'),
('Scarlett', 'Johansson', '1984-11-22'),
('Emma', 'Stone', '1988-11-06'); 