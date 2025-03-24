<?php

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

session_start();

$db = new Database();

$UserManager = new UserManager($db->getConnection());

$username = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    var_dump($_POST);

    if (isset($_POST['update'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $UserManager->update($username, $hash);

        echo 'username or password successfully updated';
    }

} else {
    echo 'unable to be updated';
}
?>