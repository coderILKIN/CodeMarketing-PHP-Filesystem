<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Css/main.css">
</head>
<body>
<?php include './partials/header.php' ?>






<form action="admin.php" method="POST">
    <button type="submit">Log Out</button>
</form>

<?php

// echo "Welcome";

// if(!isset($_SESSION['name'])){
//     header("Location: login.php");
//     exit();
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();

    $_SESSION[] = [];

    session_destroy();




    header("Location: login.php");
   
}





?>






<?php include './partials/footer.php' ?>





    


</body>
</html>