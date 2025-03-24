<?php
session_start();

if ($_SERVER ["REQUEST_METHOD"] == "POST") {

    unset($_SESSION['username']);
    session_destroy();
    header("Location: userLogin.php");

}

//controlleert of er de user is ingelogd.
if (isset($_SESSION['username'])) {
    echo "hallo " . $_SESSION['username'];

} else {
    header("Location: userLogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="POST">
<input type="submit" value="logout" name="logout">
</form>

</body>
</html>