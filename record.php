<?php 
/*
 * FIXME: decode html tags 
 */
// Open connection
$db = new SQLite3('diary.db');

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="/">OwnDiary</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item disable">
                Profile
            </li>
        </ul>

        <div class="my-2 my-lg-0">
            <?php echo "Welcome, ".$_SESSION['username'] ?>
        </div>
    </nav>
    
    <div class="card text-center">
        <div class="card-header">
            <h4> <?php echo $author ?> </h4>
        </div>
        <div class="card-body">
            <h3 class="card-title">
                <?php echo $title ?>
            </h3>
            <p class="card-text">
                <?php 
                // Allow some tags in text
                echo strip_tags($text, '<p><b><i><blockquote><br><del><strong><em><s><li><ol>'); 
                ?>
            </p>
            <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'] ?>" class="btn btn-outline-secondary">Go back</a>
        </div>
        <div class="card-footer text-muted">
            <?php echo $date ?>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
</body>

</html>