<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>


    <?php include 'helpers.php' ?>


    <?php include './partials/header.php' ?>





    <div class="container mt-5">
        <form action="login.php" method="POST">
            <input type="text" placeholder="username" name="username">
            <input type="password" placeholder="password" name="password">

            <button type="submit">Log in</button>
        </form>
    </div>




  




    <?php


    // session_start();

    // $users = isset($_COOKIE['users']) ? json_decode($_COOKIE['users'], true) : [];

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $user_found = false;

    //     foreach ($users as $user) {
    //         if ($user["username"] == $_POST["username"]) {
    //             $user_found = true;

    //             if (password_verify($_POST["password"], $user["password"])) {
    //                 $_SESSION["username"] = $user["username"];
    //                 header("Location: admin.php");
    //                 exit();
    //             } else {
    //                 echo "Parol səhvdir.";
    //                 exit();
    //             }
    //         }
    //     }

    //     if (!$user_found) {
    //         echo "İstifadəçi tapılmadı.";
    //     }
    // }

    // echo "<pre>";
    // print_r($_SESSION["username"] ?? "NULL");
    // echo "</pre>";

    ?>



<?php
session_start();

// Fayldan istifadəçi məlumatlarını oxumaq
$file = 'users.csv';
if (file_exists($file)) {
    $data = file_get_contents($file);
    $users = json_decode($data, true);
} else {
    echo "İstifadəçi məlumatları tapılmadı.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Boş inputların yoxlanması
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        echo "İstifadəçi adı və parol boş ola bilməz.";
        exit();
    }

    $user_found = false;

    foreach ($users as $user) {
        if ($user["username"] == $_POST["username"]) {
            $user_found = true;

            // Parol yoxlanması
            if (password_verify($_POST["password"], $user["password"])) {
                $_SESSION["username"] = $user["username"];
                header("Location: admin.php");
                exit();
            } else {
                echo "Parol səhvdir.";
                exit();
            }
        }
    }

    if (!$user_found) {
        echo "İstifadəçi tapılmadı.";
    }
}

// Sessiya məlumatını göstərmək üçün
echo "<pre>";
print_r($_SESSION["username"] ?? "NULL");
echo "</pre>";
?>




<?php include './partials/footer.php' ?>


</body>

</html>