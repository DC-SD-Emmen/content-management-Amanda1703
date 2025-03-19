<?php
session_start();

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

//is er een user ingelogd?
if(isset($_SESSION['username'])) {
    // echo "Hallo " . $_SESSION['username'];
} else {
    header('Location: userLogin.php');
    exit();
}

$db = new Database();
$user = new UserManager($db->getConnection());

$game_id = "";
$AddToWishlist = "";
$user_id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {    



    if(isset($_POST['AddToWishlist']) && (isset($_POST['game_id']) && (isset($_POST['user_id'])))) {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $user_name = $_SESSION['username'];
        $game_id = (int) $_POST['game_id']; 

        echo "username: " . $user_name;
        echo "<br>";
        echo "game_id: " . $game_id;
        echo "<br>";

        //user->whishlist functie aanroepen.

        $user->AddToWIshlist($_SESSION['user_id'], $game_id);
    } else {
        // header("location: index.php");
        echo "Game unable to be added";
        echo 'AddToWishlist'.(isset($_POST['AddToWishlist']));
        echo 'game_id'.(isset($_POST['game_id']));
        echo 'game_id'.(isset($_POST['user_id']));
        exit();
    }
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
    <a href="index.php"><button>homepage</button></a>
</body>
</html>