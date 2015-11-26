<!DOCTYPE HTML>
<html>
    <head>
        <title>My first PHP Website</title>
    </head>
    <body>
        <h2>Registration Page</h2>
        <a href="index.php">Click here to go back<br/><br/></a>
        <form action="register_submit.php" method="POST">
           Enter Username: <input type="text" name="username" required="required" /> <br/>
           Enter password: <input type="password" name="password" required="required" /> <br/>
           <input type="submit" name="submit" value="Register"/>
        </form>
    </body>
</html>
<?php
if(isset($_GET['db_error'])) {
    echo 'Database error!';
} else if(isset($_GET['name_taken'])){
    echo 'Username already in use. Please choose another!';
} else if(isset($_GET['unknownerr'])){
    echo 'Unknown error!';
}
?>