<?php
if (isset($_POST['upload'])) {
    $errors=array();
    $t = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];
    $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
    $fname = basename(md5(rand()).'.'.$file_ext);
    $path = getcwd() . "/uploads/" . $fname;
    $extensions=array("jpg", "jpeg", "png", "txt");
    if(in_array($file_ext, $extensions) === false) {
        $errors[] = "Extension not allowed.";
    }
    if($size > 2097152) {
        $errors[] = "File size must be 2mb or less.";
    }
    if(empty($errors)==true){
        $upload = move_uploaded_file($t, $path);
        if ($upload) {
            echo '<div class="alert alert-success" role="alert">File uploaded successfully at <a href="/uploads/'.$fname.'">/uploads/'.$fname.'</a></div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Some error occurred...</div>';
        }
    } else {
        foreach ($errors as $error) {
            echo nl2br('<div class="alert alert-danger" role="alert">'.$error.'</div>');
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="icon" href="/icons/demon.png" type="image/icon type">
    <title>holixy</title>
</head>
<body style="color: white; background-color: #131516">
    <div>
        <img src="/icons/cat.jpg" alt="">
        <p></p>
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <input type="file" id="upload" name="file" required>
            <p></p>
            <button type="submit" class="btn btn-danger" name="upload">Submit</button>
        </form>
    </div>
</body>
</html>