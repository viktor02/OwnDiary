<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - OwnDiary</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="/">OwnDiary</a>
    </nav>
    <div class="container mx-auto w-50 mt-4">
        <h1 class="text-center" >Login</h1>
        <form action="logincheck.php" method="post">
            <div class="form-group">
                <label for="formGroupExampleInput">Email</label>
                <input name="email" type="email" class="form-control" id="formGroupExampleInput" placeholder="email">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Password</label>
                <input name="password" type="password" class="form-control" id="formGroupExampleInput2" placeholder="password">
            </div>
            <button type="submit" class="btn btn-primary w-100 mx-auto">Sign in</button>
        </form>
        <p class="text-center"><a href="register.php">Sign up?</a></p>  
    </div>
    <script src="../assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>