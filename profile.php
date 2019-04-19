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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="/">OwnDiary</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item text-muted">
                Profile
            </li>
        </ul>

        <div class="my-2 my-lg-0 text-muted">
            <?php echo "Welcome, <a href='profile.php'>".$_SESSION['username']."</a>" ?>
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