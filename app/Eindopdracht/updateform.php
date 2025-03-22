<?php
$id = "";
$id = $_GET['id'] ?? $_POST['id'] ?? null;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>
    <a href="userLogin.php"><button>login</button></a>

<div class="upd">
    <form id="update" method="POST" action="update.php">
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
        <input type="text" name="username" id="username" value="">
        <input type="text" name="password" id="password" value="">
        <button type="submit" id="update" name="update">update username/password</button>
    </form>
</div>

</body>
</html>