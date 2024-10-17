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




    <?php include './partials/header.php' ?>



    <div class="container mt-5 my-5">

        <form action="register.php" method="POST">
            <input type="text" placeholder="username" name="username">
            <input type="email" placeholder="email" name="email">
            <input type="password" placeholder="password" name="password">

            <button type="submit">Register</button>
        </form>

    </div>





    <?php include './partials/footer.php' ?>





    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = trim(htmlspecialchars($_POST['username']));
        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));

        if (empty($username) || empty($email) || empty($password)) {
            trigger_error("All imputs are required", E_USER_ERROR);
        }


        $users = $_COOKIE['users'] ? json_decode($_COOKIE['users'], true) : [];


        $users[] = [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];



        setcookie("users", json_encode($users), time() + 3600, "/");

        $file = 'users.csv';
        $dataToWrite = json_encode($users, JSON_PRETTY_PRINT);
        file_put_contents($file, $dataToWrite);
    
        header("Location: login.php");
        exit();
    }

    ?>





</body>

</html>