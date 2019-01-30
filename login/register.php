<?php 
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
	
	// Оборачивание, чтобы запрос прошел в базу
	$email = '"'.htmlspecialchars($email).'"';
	
	// Double hashing SHA1
	$password = sha1(sha1($password));
	// Оборачивание, чтобы запрос прошел в базу
	$password = '"'.htmlspecialchars($password).'"';

	// Request to base
	$req = "INSERT INTO logins (email, password ) 
		VALUES (".$email."," . $password.")";

	// run and check for errors
	if($db->exec($req)) {
		echo "<div class='center'>
		Congratulation! You registered! Now <a href='login.php'>login</a>
		</div>";
	}
	else{
		echo "Error: ".$req;
	}

}
// echo "email: ".$email."<br>Password: ".$password;


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
				<input id="email" type="email" class="validate" name="email">
				<label for="email">Email</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input id="password" type="password" class="validate" name="password">
				<label for="password">Password</label>
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