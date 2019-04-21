<?php 
// Open sqlite3 database
$db = new SQLite3('../diary.db');
session_start();

// $currentEmail = $_SESSION['email'];
// $results = $db->query("SELECT role from logins where email = '$currentEmail' ");

// $row = $results->fetchArray();

// If don't sign in
if (!isset($_SESSION['email'])) {
    die(header('Location: login/login.php'));
}
// If I'm have admin role
if( $_SESSION['role'] != 'admin'){
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
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
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
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <?php if($_SESSION['role'] == 'admin'){
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link active' href='/admin/'>Admin panel</a>";
                    echo "</li>";
                }
                ?>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#deletePost"
                aria-expanded="true" aria-controls="collapseExample">
                Delete post
            </button>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#deleteUser"
                aria-expanded="false" aria-controls="collapseExample">
                Delete user
            </button>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#setRole"
                aria-expanded="false" aria-controls="collapseExample">
                Set role
            </button>
        </p>
        <div class="collapse" id="deletePost">
            <form action="deleteUser.php" method="post" class="mt-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Delete post" aria-label="Delete post"
                        aria-describedby="basic-addon2" name="id">
                    <div class="input-group-append">
                        <input class="btn btn-outline-secondary" type="submit"></input>
                    </div>
                </div>
            </form>
        </div>
        <div class="collapse" id="deleteUser">
            <form action="deleteUser.php" method="post" class="mt-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Delete user" aria-label="Delete user"
                        aria-describedby="basic-addon2" name="id">
                    <div class="input-group-append">
                        <input class="btn btn-outline-secondary" type="submit"></input>
                    </div>
                </div>
            </form>
        </div>
        <div class="collapse" id="setRole">
            <form action="setRole.php" method="post" class="mt-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="id" aria-label="id"
                        aria-describedby="basic-addon2" name="id">
                    <input type="text" class="form-control" placeholder="Set role" aria-label="set role"
                        aria-describedby="basic-addon2" name="role">
                    <div class="input-group-append">
                        <input class="btn btn-outline-secondary" type="submit"></input>
                    </div>
                </div>
            </form>
        </div>
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
    <script src="../assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>

<?php 
// Close connection with db
$db->close();
?>