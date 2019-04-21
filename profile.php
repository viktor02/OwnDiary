<?php 
session_start();

if (!isset($_SESSION['email'])) {
    die(header('Location: login/login.php'));
}
// Open sqlite3 database
$db = new SQLite3('diary.db');

$email = $_SESSION['email'];
$req = "SELECT * FROM 'logins' WHERE email='$email'";

$result = $db->query($req);
$row = $result->fetchArray();

$id = $row['id'];
$email = $row['email'];
$name = $row['name'];
$username = $row['username'];
$birthday = $row['birthday'];
$regdate = $row['regdate'];

$db->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php echo $_SESSION['username']?>
    </title>
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
                <li class="nav-item">
                    <a class="nav-link" href="/">Home </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profile.php">Profile <span class="sr-only">(current)</span></a>
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
        <h1>
            <?php echo $username ?>
        </h1>
        <h3 class="text-muted">
            <?php echo $name ?>
        </h3>
        <a href="login/logout.php" class="btn btn-secondary btn-lg" role="button" aria-disabled="true">Logout</a>
    </div>

    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>