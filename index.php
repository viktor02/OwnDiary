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

// Authorization
// Create table if she doesn't exist
if ($db->exec("CREATE TABLE if not exists 'logins'
		('id' INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL  UNIQUE , 
		'email' TEXT,
		'password' TEXT
		)
"))

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
    <title>OwnDiary - your diary.</title>

    <!-- Use materialize framework -->
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>
    <div class="header center">
        <?php echo "Welcome, ".$_SESSION['email']."" ?> <br>
        <a href="login/logout.php">Logout</a>
        <a href=""></a>
    </div>
    <div class="container">
        <h1 class="center">OwnDiary</h1>
        <!-- Form for quicken add record -->
        <form action="manage/addRecord.php" method="post">
            <div class="input-field col s12">
                <h5 class="center">Quick add record to diary.</h5>
                <input type="text" name="title" placeholder="Title"> </input>
                <textarea id="textarea1" name="textarea" class="materialize-textarea" placeholder="Add record"></textarea>
                <div class="center-align">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button>
                    <a class="waves-effect waves-light btn" href="manage/editor.php">Or go in editor</a>
                </div>

            </div>
        </form>
        <div>
            <h5 class="center">All records</h5>
            <div>
                <?php 
                // Parse data from DB, order by 'id' desc(100..1)
                $results = $db->query('SELECT * FROM diary ORDER by id DESC');
                while ($row = $results->fetchArray()) {
                    echo "<a href='/manage/record.php?id=".$row['id']."'><h5> ".$row['title']."</h5> </a>" // Header and link to full record
                    ."<blockquote>".$row['date']." by ".$row['author']."</blockquote>" // date & author
                    ."<p class='truncate'>".$row['text']."</p>" // truncated text
                    ."<div class='divider'></div>"; // divider, also can use <hr>
                }

                // Close connection
                $db->close();
            ?>
            </div>
        </div>
        <div class="footer">
            <p>Viktor Karpov 2019</p>
        </div>
    </div>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>