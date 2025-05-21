<!DOCTYPE HTML>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title> Log In </title>
<!-- linking style sheet -->
<link rel = "stylesheet" href = "css/main.css">
</head>

<body>

<div class="logo"></div>

<form action = "login.php" method = "POST">
    <label for="username">Username</label>
    <input id ="username" class= input-box type="text" name="username" required><br>


    <label for="password">Password</label>
    <input id="password" class="input-box" type="password" name="password" required>

    <button type="submit" class="btn">Log In</button>

</form>

<?php
//color hex codes from logo for websites = #003366 (navy blue)  and #ffdb5c (yellow) 
?>

</body>
</html>

