<?php

session_start();

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

$db = new Database();
$gameManager = new GameManager($db->getConnection());

if ($_SERVER ["REQUEST_METHOD"] == "POST") {

    if(isset($_SESSION['username'])) {
        if(isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header("Location: userLogin.php");
            exit();
        }
    }


    if(isset($_POST['addgame'])) {
        $gameManager->fileUpload($_FILES['image']);
        $gameManager->insertGame($_POST, $_FILES['image']['name']);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1.0, initial-scale=1.0">
    <link rel="stylesheet" href="styling.css">
    <title>yaaaaay</title>
</head>
<body>

<?php include 'game-form.php'; ?>

<div class="grid-container">

            <form method="POST">
                <button type="submit" id="Logout" name="logout">Logout</button>
            </form>


        <div lass="grid-item" id="gridItem1">
            Homepage
            Library
            Discover
            <button type="button" id="add-button">add game</button>
            <a href='userLogin.php'><button id="login-button">login</button></a>
            <a href='wishlist.php'><button id='wishlist'>wishlist</button></a>
           
        </div>


        <div lass="grid-item" id="gridItem2">
            <div class="grid-items">
            <div lass="grid-item" id="gridItem3">


<div class="text-container" id="text">

        <h1>Gamelibrary</h1>

        <p>Here in this gamelibrary you have a good and direct overview of your games.</p>
</div>
</div>
<div lass="grid-item" id="gridItem5">
       <p id="bar">sidebar</p>
       <?php $gameManager->selectDataSideBar(); ?>

</div>
<div lass="grid-item" id="gridItem4">


    <div id='games-container'>
       <!-- <div> -->
        <?php $gameManager->selectData(); ?>
     
    </div>

<script src='javascript.js'></script>
</div>

</body>
</html>