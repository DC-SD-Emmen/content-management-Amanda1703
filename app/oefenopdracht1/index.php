<?php

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

    include 'userregister.php';
    include 'userLogin.php';
    include 'userHandling.php';
    include 'javascript.js';
    include 'game-form.php';
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

<div class="grid-container">
        <div lass="grid-item" id="gridItem1">
            Homepage
            Library
            Discover
            <button type="button" id="add-button">add game</button>
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
       <?php $GameManager->selectDataSideBar(); ?>

</div>
<div lass="grid-item" id="gridItem4">


    <div id='games-container'>
       <!-- <div> -->
        <?php $GameManager->selectData(); ?>
     
    </div>

<script src='javascript.js'></script>
</div>

</body>
</html>