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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">OwnDiary</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
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
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>