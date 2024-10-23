<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

    <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Name</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="username">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    

    </div>



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


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>