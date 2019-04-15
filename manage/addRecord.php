<?php 
session_start();

// Protection against xss attacks
$text =  SQLite3::escapeString(htmlentities($_POST["textarea"]));

$title = SQLite3::escapeString(htmlentities($_POST["title"]));
$date = SQLite3::escapeString(htmlentities($_POST["date"]));

$author = SQLite3::escapeString(htmlentities($_SESSION["username"]));

if(strlen($date) <= 2){
    $date = htmlentities(date("F j, Y, H:i")); // Example: January 21, 2019, 16:24
}

// Change perms
if (substr(sprintf('%o', fileperms('/tmp')), -4) !== 0666){
    chmod("../diary.db", 0666);
}
// Open connection with db
$db = new SQLite3('../diary.db');


// Request to base
$req = "INSERT INTO diary (title, author, date, text ) 
    VALUES ('$title','$author','$date','$text')";

// run and check for errors
if(!$db->exec($req)) {
    exit("Error");
} 

// Close connection with db
$db->close();
$host = $_SERVER['HTTP_HOST'];
// Redirect to host site
header("Location: http://$host");
exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Added. Redirect</title>
</head>

<body>
    <h1>You will be redirected. If not, click <a href=<?php echo 'http://' .$host ?> >here</a>.</h1>
</body>

</html>