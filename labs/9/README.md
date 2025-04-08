# Lab 9: Databases & SQL

## Setup Instructions

1. Create a new database named "iit" in phpMyAdmin with collation utf8mb4_general_ci
2. Import the iit-lab9start.sql file into the database
3. Copy all files from the inclassexample directory to your lab9 directory
4. Make sure your server is running and accessible

## Lab Requirements

1. Actors table has been created with fields for autoincrement primary key, first name, last name, and date of birth
2. Sample actors have been added to the actors table (including some born before 1960)
3. A SQL query has been provided to export actors born on or after 1960 to CSV
4. A movie_actors relationship table has been created and populated with sample relationships
5. The movies.php file has been completed to list movies
6. (Extra credit) A movie-actors.php file has been added to show movies and their corresponding actors

## How to Use

1. Access the application at http://[yourFQDN]/iit/lab9/
2. Use the tabs to navigate between Actors, Movies, and Movie Actors
3. Add, view, and delete actors and movies
4. To export actors born on or after 1960 to CSV:
   - Go to phpMyAdmin
   - Select the "iit" database
   - Click on the "SQL" tab
   - Copy and paste the contents of actors_after_1960.sql
   - Click "Go"
   - Click on the "Export" tab
   - Select "CSV for MS Excel" format
   - Click "Go" to download the CSV file

## Files Included

- iit-lab9start.sql: Contains the SQL to create and populate the movies, actors, and movie_actors tables
- index.php: Main page for managing actors
- movies.php: Page for managing movies
- movie-actors.php: Page for viewing movies and their actors (extra credit)
- actor-delete.php: Handles actor deletion
- movie-delete.php: Handles movie deletion
- actors_after_1960.sql: SQL query to export actors born on or after 1960
- includes/: Directory containing PHP include files
- resources/: Directory containing CSS, JavaScript, and image files 