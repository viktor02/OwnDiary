<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - OwnDiary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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