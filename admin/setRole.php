<?php
session_start();
// If don't sign in
if (!isset($_SESSION['email'])) {
    die(header('Location: login/login.php'));
}
// If I'm have admin role
if( $_SESSION['role'] != 'admin'){
    $host = $_SERVER['HTTP_HOST'];
    die(header("Location: http://$host"));
}

$db = new SQLite3('../diary.db');

$id = SQLite3::escapeString($_POST['id']);
$role = SQLite3::escapeString($_POST['role']);

$req = "UPDATE logins SET role = '$role' WHERE id = '$id';";

if(!$db->exec($req)){
    die("Error");
}
else{
    // Back
    echo "Success";
    echo "<script>window.history.go(-1);</script>";
}

$db->close();
die();
?>