<?php 
// Open sqlite3 database
$db = new SQLite3('../diary.db');
session_start();
$currentEmail = $_SESSION['email'];
$results = $db->query("SELECT role from logins where email = '$currentEmail' ");

$row = $results->fetchArray();

// If don't sign in
if (!isset($_SESSION['email'])) {
    die(header('Location: login/login.php'));
}
// If I'm have admin role
if( $row['role'] != 'admin'){
    $host = $_SERVER['HTTP_HOST'];
    die(header("Location: http://$host"));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="/">OwnDiary</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item disable">
                Admin panel
            </li>
        </ul>

        <div class="my-2 my-lg-0">
            <?php echo "Welcome, <a href='profile.php'>".$_SESSION['username']."</a>" ?>
        </div>
    </nav>
    <div class="container mt-4">
        <form action="deletePost.php" method="post" class="mt-3">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Delete user" aria-label="Delete user"
                    aria-describedby="basic-addon2" name="id">
                <div class="input-group-append">
                    <input class="btn btn-outline-secondary" type="submit"></input>
                </div>
            </div>
        </form>
        <p>Or</p>
        <form action="deleteUser.php" method="post" class="mt-3">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Delete post" aria-label="Delete post"
                    aria-describedby="basic-addon2" name="id">
                <div class="input-group-append">
                    <input class="btn btn-outline-secondary" type="submit"></input>
                </div>
            </div>
        </form>
        <h2 class="mt-2">List of records</h2>
        <!-- List of records -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $results = $db->query("SELECT * FROM 'diary' ORDER by id ASC");
                
                while ($row = $results->fetchArray()) {
                    /* FIXME: Offhhh, its can be dangerous? */

                    $id = $row['id'];
                    $id = "<a href='/manage/record.php?id=$id'>$id</a>";
                    $title = $row['title']; 
                    $author = $row['author'];
                    $date = $row['date'];

                    echo "
                    <tr>
                    <th scope='row'> $id </th> 
                    <td> $title </td>
                    <td> $author </td>
                    <td> $date </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
        <!-- List of users -->
        <h2 class="mt-2">List of users</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Hash of password</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $results = $db->query("SELECT * FROM 'logins' ORDER by id ASC");
                
                while ($row = $results->fetchArray()) {
                    /* FIXME: Offhhh, its can be dangerous? */

                    $id = $row['id'];
                    $id = "<a href='../profile.php?id=$id'>$id</a>";
                    $email = $row['email']; 
                    $username = $row['username'];
                    $name = $row['name'];
                    $password = $row['password'];
                    $role = $row['role'];
                    echo "
                    <tr>
                    <th scope='row'> $id </th> 
                    <td> $username </td>
                    <td> $name </td>
                    <td> $email </td>
                    <td> $role </td>
                    <td> $password </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php 
// Close connection with db
$db->close();
?>