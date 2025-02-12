<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>yaaaaay</title>
</head>
<body>

<?php

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

$db = new Database();
$userManager = new UserManager($db->getConnection());

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    //filtering toepassen
    //(htmlspecialchars())

    //password hash() toepassen
    //voorbeeld: echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT);

    //usermanager - > inserData oproepen
}

?>
    <form id="sendForm">
        <label for="username">username</label><br>
        <input type="text" id="username" name="" required><br>
        <label for="password">password</label><br>
        <input type="text" id="password" name="" required><br>
        <button type="submit">log in</button>
    </form>
</body>
</html>