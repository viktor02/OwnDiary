<?php 
// Protection against xss attacks, also for correctly insert to db
$text = '"'.htmlspecialchars($_POST["textarea"]).'"';

$title = '"'.htmlspecialchars($_POST["title"]).'"';
$date = '"'.htmlspecialchars($_POST["date"]).'"';
if(strlen(date) <= 0){
    $date = '"'.htmlspecialchars(date("F j, Y, H:i")).'"'; // Example: January 21, 2019, 16:24
}
// Open connection with db
$db = new SQLite3('../diary.db');

// Create table if not exist
if ($db->exec("CREATE TABLE if not exists 'diary'
		('id' INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL  UNIQUE , 
		'title' TEXT,
		'date' TEXT,
		'text' TEXT
		)
"));
// Request to base
$req = "INSERT INTO diary (title, date, text ) 
    VALUES (".$title."," . $date . "," . $text .")";

// run and check for errors
if(!$db->exec($req)) {
    //echo $req;
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