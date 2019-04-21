<?php 

$id = SQLite3::escapeString(htmlentities( $_POST['id'] ));

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
$req = "DELETE FROM 'diary' WHERE id = $id";
if(!$db->query($req)){
    die("Error.");
}
// Close connection with db
$db->close();

// Go back
// header("Location: ".$_SERVER['HTTP_REFERER']);
echo "Success";
echo "<script>window.history.go(-1);</script>";
die();
?>