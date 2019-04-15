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
        'name' TEXT,
		'username' TEXT,
		'password' TEXT,
		'salt' TEXT
		) 
	"))

$email = SQLite3::escapeString(htmlentities($_POST["email"]));
$username = SQLite3::escapeString(htmlentities($_POST["username"]));
$name = SQLite3::escapeString(htmlentities($_POST["name"]));
$password = SQLite3::escapeString(htmlentities($_POST["password"]));
$birthday = SQLite3::escapeString(htmlentities($_POST['birthday']));

$salt = generateRandomString();

if(!empty($email) AND !empty($password)){
	// hashing SHA1 with salt
	$password = sha1($password . $salt);
	
	// Request to base
	$req = "INSERT INTO logins (email, name, username, password, salt ) 
		VALUES ('$email', '$name','$username', '$password',  '$salt')";

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
    <title>Sign up - OwnDiary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
                <input type="text" id="usernamelabel" name="username" class="form-control" placeholder="Username" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
            <button type="submit" class="btn btn-primary w-100 mx-auto">Sign up</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
</body>

</html>