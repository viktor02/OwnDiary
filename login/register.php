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
		('id' INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL  UNIQUE,
		'email' TEXT,
		'name' TEXT,
		'username' TEXT,
		'password' TEXT,
		'salt' TEXT,
		'regdate' DATE,
		'birthday' TEXT,
		'role' TEXT
		)
	"))

$email = SQLite3::escapeString(htmlentities($_POST["email"]));
$username = SQLite3::escapeString(htmlentities($_POST["username"]));
$name = SQLite3::escapeString(htmlentities($_POST["name"]));
$password = SQLite3::escapeString(htmlentities($_POST["password"]));
$birthday = SQLite3::escapeString(htmlentities($_POST['birthday']));
$regdate = htmlentities(date("F j, Y, H:i")); // Example: January 21, 2019, 16:24

$salt = generateRandomString();

if(!empty($email) AND !empty($password)){
	/*
	 * IF EMAIL AND PASSWORD FIELD NOT EMPTY
	 */

	// Check if this account has exists
	$emailCheckReq = "SELECT email FROM logins WHERE email='$email'";

	$result = $db->query($emailCheckReq);
    $row = $result->fetchArray();
	$dbEmail = $row['email'];

	// Binary safe case-insensitive string comparison
	if( strcasecmp($dbEmail, $email) == 0 ){
		echo "<div class='alert alert-warning text-center' role='alert'>
		This email has exist! </div>";
	}
	else{
		/* 
		 * REGISTRATION
		 */
		// hashing SHA1 with salt
		$password = sha1($password . $salt);
		
		// Request to base
		$req = "INSERT INTO logins (email, name, username, password, salt, regdate, birthday, role ) 
			VALUES ('$email', '$name','$username', '$password',  '$salt', '$regdate', '$birthday', 'user')";

		// run and check for errors
		if($db->exec($req)) {
			echo "
			<div class='alert alert-success text-center' role='alert'>
				Successful! Now <a href='login.php'>login</a> 
			</div>
			";
		}
		else{
			echo "
			<div class='alert alert-danger text-center' role='alert'>
				Error. Try again.
			</div>
			";
		}

	}
}
else{
	/* 
	 * FIELD IS EMPTY, just reload page
	 */

	// echo "
	// <div class='alert alert-danger text-center' role='alert'>
	// 	Email or password field is empty!
	// </div>
	// ";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up - OwnDiary</title>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="/">OwnDiary</a>
    </nav>
    <div class="container mx-auto w-50 mt-4">
        <h1 class="text-center">Sign up</h1>
        <form action="" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input name="email" type="email" class="form-control" id="inputEmail4" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input name="password" type="password" class="form-control" id="inputPassword4"
                        placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Name</label>
                <input name="name" type="text" class="form-control" id="formGroupExampleInput" placeholder="Your name">
            </div>

            <label for="usernamelabel">Username</label>
            <div class="form-group input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" id="usernamelabel" name="username" class="form-control" placeholder="Username"
                    aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <div class="form-group row">
                <label for="example-date-input" class="col-2 col-form-label">Birthday</label>
                <div class="col-10">
                    <input class="form-control" type="date" value="2011-08-19" name="birthday" id="example-date-input">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mx-auto">Sign up</button>
        </form>
    </div>
    <script src="../assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>