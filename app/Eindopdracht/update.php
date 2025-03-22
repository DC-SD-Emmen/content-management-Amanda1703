<?php

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

session_start();

$db = new Database();

$UserManager = new UserManager($db->getConnection());

$id = "";
$username = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    var_dump($_POST);

    if (isset($_POST['update'])) {
        $id = $_SESSION['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $UserManager->update($username, $password, $id);

        echo 'username or password successfully updated';
    }

} else {
    echo 'unable to be updated';
}
?>