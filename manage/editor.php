<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editor</title>

    <!-- Import CKEditor -->
    <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
    
    <!-- Import Materialize Framework -->
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>
<script>
function goBack() {
  window.history.back();
}
</script>
<div class="container">
    <h3 class="center"><a href="https://ckeditor.com/">CKEditor</a></h3>
    <!-- Form -->
    <form action="addRecord.php" method="post">
        <!-- Title and date -->
        <input type="text" name="title" placeholder="Title">
        <input type="text" name="date" placeholder="<?php echo date("F j, Y, H:i") ?>">
        <!-- CKEditor -->
        <textarea name="textarea" id="editor1" rows="10" cols="80">
                This is my textarea to be replaced with CKEditor.
        </textarea>
        <!-- Buttons -->
        <div class="center-align">
        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
            <i class="material-icons right">send</i>
        </button>
        </div>

        <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        </script>
    </form>
</div>
</body>

</html>