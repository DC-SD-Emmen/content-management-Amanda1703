<?php

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

session_start();

$db = new Database();

$UserManager = new UserManager($db->getConnection());

$username = "";
$password = "";

//controleert of de update knop is gedrukt
if ($_SERVER["REQUEST_METHOD"] == "POST") { 


    if (isset($_POST['update'])) {
        $username = $_POST['username']; //haalt variabele op.
        $password = $_POST['password'];

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $UserManager->update($username, $hash);//stuurt variabelen mee.

        echo 'username or password successfully updated';
    }

} else {
    echo 'unable to be updated';
}
?>