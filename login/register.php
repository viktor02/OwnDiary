<?php 
// Thanks Stephen Watkins from StackOverflow
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Open sqlite3 database
$db = new SQLite3('../diary.db');

// Authorization
// Create table if she doesn't exist
if ($db->exec("CREATE TABLE if not exists 'logins'
		('id' INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL  UNIQUE , 
		'email' TEXT,
		'password' TEXT,
		'salt' TEXT
		)
"))

$email = $_POST['email'];
$email = htmlspecialchars($email);
$password = $_POST['password'];
$password = htmlspecialchars($password);

$salt = generateRandomString();

if(!empty($email) AND !empty($password)){
	// hashing SHA1 with salt
	$password = sha1($password . $salt);
	
	// Request to base
	$req = "INSERT INTO logins (email, password, salt ) 
		VALUES ('$email', '$password', '$salt')";

	// run and check for errors
	if($db->exec($req)) {
		die("<div class='center'>
		Congratulation! You registered! Now <a href='login.php'>login</a>
		</div>");
	}
	else{
		die("Error");
	}

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login</title>
	<!-- Use materialize framework -->
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>
	<div class="container">
		<div class="center">
			<h1>Register</h1>
		</div>
		<form action="" method="post">
		<div class="row">
			<div class="input-field col s12">
				<input id="email" type="email" class="validate" name="email" placeholder="Email">
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input id="password" type="password" class="validate" name="password" placeholder="Password">
			</div>
		</div>
		<div class="row center" >
		<!-- Buttons -->
		<div class="center-align">
		<button class="btn waves-effect waves-light" type="submit" name="action">Submit
			<i class="material-icons right">send</i>
		</button>
		</form>
		</div>
		</div>

	</div>
</body>

</html>