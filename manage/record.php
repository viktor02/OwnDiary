<?php 
// Open connection
$db = new SQLite3('../diary.db');

$id = htmlspecialchars($_GET["id"]);

// Request
$results = $db->query('SELECT * FROM diary WHERE id='.$id);

// Array with data
$row = $results->fetchArray();
$title = $row['title'];
$author = $row['author'];
// Decode html tags.
// Remake. I don't know how make it normally
/* 
In short. At the same time, a string is added to the database, which is encoded by the htmlspecialchars function (so that when adding to the database there are no errors), here it will be displayed back with tags, then all tags except for certain ones are deleted.
*/
$text = htmlspecialchars_decode($row['text']);

$date = $row['date'];

$host = $_SERVER['HTTP_HOST'];
$host = "'"."http://".$host."'";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php echo $title ?>
    </title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>
    <div class="container">
        <h1 class="center"><a class="black-text" href=<?php echo $host ?> >OwnDiary</a></h1>
        <h2>
            <?php echo $title ?>
        </h2>
        <blockquote>
        <!-- Print date and author -->
            <?php echo $date ?>
            <?php echo "<br><strong>".$author."</strong>" ?>
        </blockquote>
        <p></p>
        <p>
            <?php 
            // Allow some tags in text
            echo strip_tags($text, '<p><b><i><blockquote><br><del><strong><em><s><li><ol>'); 
            ?>
        </p>
        <div class="center-align" style="padding: 20px;"><a class="waves-effect waves-light btn-large" href=<?php echo $host ?> >Back</a></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>