<?php 
/*
 * FIXME: decode html tags 
 */
// Open connection
$db = new SQLite3('diary.db');
session_start();
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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">OwnDiary</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Record <span class="sr-only">(current)</span></a>
                </li>
                <?php if($_SESSION['role'] == 'admin'){
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='/admin/'>Admin panel</a>";
                    echo "</li>";
                }
                ?>
            </ul>
        </div>
    </nav>
    <div class="card text-justify">
        <div class="card-header text-left">
            <h4 class="col-4"> <?php echo $author ?> </h4>
            <p class="col-4 text-muted"> <?php echo $date ?> </p>
        </div>
        <div class="card-body container">
            <h3 class="card-title">
                <?php echo $title  ?>
            </h3>
            <p class="card-text " style="white-space: pre-line">
                <?php 
                // Allow some tags in text
                echo strip_tags($text, '<p><b><i><blockquote><br><del><strong><em><s><li><ol>'); 
                ?>
            </p>
            <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'] ?>" class="btn btn-outline-secondary">Go back</a>
        </div>
    </div>

    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>