<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Form</title>
</head>
<body>
    <a href="userlogin.php"><button>login</button></a>

<div class="reg">
    <form id="registpage" method="post" action="userHandling.php">
        <label for="email"></label><br>
        <input type="email" id="email" name="email" placeholder="email" required><br>
        <label for="username"></label><br>
        <input type="text" id="username" name="username" placeholder="username"required><br>
        <label for="password"></label><br>
        <input type="password" id="password" name="password" placeholder="password" required><br>
        <input type="submit" name="register" id="register" value="register"></input>
    </form> 
</div>
</body>
</html>

