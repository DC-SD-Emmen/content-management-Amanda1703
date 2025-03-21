<?php

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

session_start();

$db = new Database();

$UserManager = new UserManager($db->getConnection());


if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    if (isset($_POST['update'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $UserManager->update($username, $password);
    }

} else {
    echo 'unable to be updated';
}









?>