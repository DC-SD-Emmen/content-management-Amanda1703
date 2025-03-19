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

$id = "";
$AddToWishlist = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

echo ''.isset($_POST['AddToWishlist']);
echo ''.(isset($_POST['id']));


    if(isset($_POST['AddToWishlist']) && (isset($_POST['id']))) {
        $user_name = $_SESSION['username'];
        $id = (int) $_POST['id']; 

        echo "username: " . $user_name;
        echo "<br>";
        echo "id: " . $id;

        //user->whishlist functie aanroepen.

        $user->AddToWIshlist($_SESSION['user_id'], $id);
    } else {
        // header("location: index.php");
        echo "Game unable to be added";
        exit();
    }
}
?>