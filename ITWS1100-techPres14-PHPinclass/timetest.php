<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Lets get the time</title>
</head>

<body>

 <h1>forgot your watch?</h1>

    <form method="post">
        <input type="submit" name="getTime" value="click me for the time">
    </form>

    <hr>

    <?php
    if(isset($_POST['getTime'])) {
        echo "<p>woohoo, the time is now: " . date('H:i:s') . "</p>";
    }
    ?>

</body>
</html>


   