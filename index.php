<?php 
// Open sqlite3 database
$db = new SQLite3('diary.db');
session_start();

// Create table if not exist
if ($db->exec("CREATE TABLE if not exists 'diary'
		('id' INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL  UNIQUE , 
		'title' TEXT,
		'author' TEXT,
		'date' TEXT,
		'text' TEXT
		)
"));

if (!isset($_SESSION['email'])) {
    die(header('Location: login/login.php'));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OwnDiary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="/">OwnDiary</a>
        <div class="my-2 my-lg-0 text-muted">
            <?php echo "Welcome, <a href='profile.php'>".$_SESSION['username']."</a>" ?>
        </div>
    </nav>

    <div class="container">
        <form action="manage/addRecord.php" method="post" class="mt-3">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Title" aria-label="Title"
                    aria-describedby="basic-addon2" name="title">
                <div class="input-group-append">
                    <input class="btn btn-outline-secondary" type="submit"></input>
                </div>
            </div>

            <textarea class="form-control mt-2" name="textarea" rows="3" placeholder="Your text here."></textarea>

        </form>
        <hr>
        <h1>Your records</h1>
        <div class="mt-4">
        <?php 
            $author = SQLite3::escapeString(htmlspecialchars($_SESSION["username"]));
            
            // Parse data from DB, order by 'id' desc(100..1)
            $results = $db->query("SELECT * FROM diary WHERE author = '$author' ORDER by id DESC");
            while ($row = $results->fetchArray()) {
                echo "<a style='text-decoration: none'  href='record.php?id=".$row['id']."'><h3> ".$row['title']."</h3> </a>" // Header and link to full record
                ."<p class='font-italic text-muted'>".$row['date']." by <em>".$row['author']."</em></p>" // date & author
                ."<p class='text-truncate'>".$row['text']."</p>" // truncated text
                ."<hr>"; // divider
            }

            // Close connection
            $db->close();
        ?>
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