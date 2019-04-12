<?php 

session_start();

// Open sqlite3 database
$db = new SQLite3('../diary.db');

$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

if(!empty($email) AND !empty($password)){	
	// Request to base
    $req = "SELECT * FROM logins WHERE email='$email'";

    $result = $db->query($req);
    $row = $result->fetchArray();
    $salt = $row['salt'];
    $dbpass = $row['password'];
    // hashing SHA1 with salt
    $password = sha1($password . $salt );

	// run and check for errors
    if($dbpass == $password) {
        $_SESSION['email'] = $row['email']; // set session
        $_SESSION['validateTime'] = time(); // set session
        $_SESSION['nickname'] = $row['nickname'];
        die(header('Location: ../index.php'));
    }
    else{
        die("Failed. Try again");
    }
}
else{
		die("Error: Fields is empty");
	}

?>