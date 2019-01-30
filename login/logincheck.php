<?php 
session_start();

// Open sqlite3 database
$db = new SQLite3('../diary.db');

// Authorization
// Create table if she doesn't exist
if ($db->exec("CREATE TABLE if not exists 'logins'
		('id' INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL  UNIQUE , 
		'email' TEXT,
		'password' TEXT
		)
"))

$email = $_POST['email'];
$password = $_POST['password'];

if(!empty($email) AND !empty($password)){
	// echo "Не пусты";
	// $email = '"'.htmlspecialchars($email).'"';
	
	// Double hashing SHA1
	$password = sha1(sha1($password));
    // $password = '"'.htmlspecialchars($password).'"';
    
	// Request to base
    $req = "SELECT * FROM logins WHERE email='$email' AND password='$password'";

	// run and check for errors
	if($db->query($req)) {
        // WARNING!!
        // BUGS! Its create a double requests for one login! DANGEROUS
        // NEED TO FIX
        // WARNING!!

        $result = $db->query($req);
        $row = $result->fetchArray();
        if($row == false){
            die("Authorization failed.");
            //echo $email.'//'.$password;
        }
        else{
            // echo "Welcome, $email";
            //echo $email.'//'.$password;
            $_SESSION['email'] = $row['email']; //Ставим инфу сессии.
            $_SESSION['validateTime'] = time(); //Ставим инфу сессии.
            die(header('Location: ../index.php'));
            // header('Location: ../index.php');
        }
	}
	else{
		die("Error: ");
	}

}

?>