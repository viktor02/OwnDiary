<?php 

$id = SQLite3::escapeString(htmlentities( $_POST['id'] ));

session_start();

// if user dont login
if (!isset($_SESSION['email'])) {
    $host = $_SERVER['HTTP_HOST'];
    die(header("Location: http://$host"));
}
// if user not a admin
if( $_SESSION['email'] != 'vitka.k@yandex.ru'){
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
header("Location: ".$_SERVER['HTTP_REFERER']);
?>