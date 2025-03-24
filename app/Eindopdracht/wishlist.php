<?php
session_start();

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 0;

//is er een user ingelogd?
if(isset($_SESSION['user_id'])) {
    // echo "Hallo " . $_SESSION['user_id'];
} else {
    header('Location: userLogin.php');
    exit();
}

$db = new Database();
$user = new UserManager($db->getConnection());

$game_id = "";
$AddToWishlist = "";
$user_id = "";

// Set session variables

// echo "Session variables are set.";


if ($_SERVER["REQUEST_METHOD"] == "POST") {    

    if(isset($_POST['AddToWishlist'])) {

        $user_name = $_SESSION['username'];

        $user_id = $_POST['user_id'];
       
        $game_id = $_POST['game_id'];

        // echo "username: " . $user_name;
        // echo "<br>";
        // echo "game_id: " . $game_id;
        // echo "<br>";

        //user->whishlist functie aanroepen.
        $user->AddToWIshlist($_SESSION['user_id'], $game_id);

    } else {
        // header("location: index.php");
        echo "Game unable to be added";
        echo 'AddToWishlist'.(isset($_POST['AddToWishlist']));
        echo 'game_id'. ($_POST['game_id']);
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
    <link rel="stylesheet" href="wishlist.css">
    <title>Document</title>
</head>
<body>
    <h2>Wishlist</h2>

    <?php    
        $user->Wishlist($_SESSION['user_id']);
    ?>

    <a href="index.php" class="homepage">homepage</a>

</body>
</html>