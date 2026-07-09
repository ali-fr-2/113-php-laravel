<?php

$errorUserNotFound = false;
$errorEmpty = false;
$errorNotValidPhone = false;
$errorIncorect = false;
$errorStatus = false;
include "./database/pdo_connection.php";
if (isset($_POST['submit'])) {
    if (isset($_POST['phone']) && $_POST['phone'] !== '' && isset($_POST['password']) && $_POST['password'] !== '') {
        $phone = trim($_POST['phone']);
        $password = trim($_POST['password']);
        if (preg_match('/^09\d{9}$/', $phone)) {
            $result = $conn->prepare(
                "SELECT id,username,role,password,status FROM users WHERE phone=?"
            );
            $result->bindValue(1, $phone);
            $result->execute();
            $user = $result->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                if ($user['status'] == 1) {
                    if (password_verify($password, $user['password'])) {
                        session_start();

                        session_regenerate_id(true);

                        $_SESSION['logged_in'] = true;
                        $_SESSION['id']        = $user['id'];
                        $_SESSION['role']      = $user['role'];
                        $_SESSION['phone']      = $user['phone'];
                        $_SESSION['username']  = $user['username'];
                        $_SESSION['last_login'] = date('Y-m-d H:i:s');

                        setcookie("phone",$user['phone'],time()+86400);

                        header("Location: PANEL\index.php");
                        exit;
                    } else {
                        $errorIncorect = true;
                    }
                } else {
                    $errorStatus = true;
                }
            } else {
                $errorUserNotFound = true;
            }
        } else {
            $errorNotValidPhone = true;
        }
    } else {
        $errorEmpty = true;
    }
}
?>



<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/style.css">
    <link rel="stylesheet" href="styles/css/auth.css">
    <!-- Css Reset -->
    <link rel="stylesheet" href="styles/css/reset.css">
    <!-- Vazir Font -->
    <link rel="stylesheet" href="fonts/vazir.css">
    <!-- Fontawsome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>ورود به حساب کاربری</title>
</head>

<body>
    <section class="d-flex justify-content-center align-items-center min-h-screen bg">
        <div id="overlay"></div>
        <div class="form-container">
            <form action="#" method="post">
                <h1 class="title">ورود به حساب کاربری</h1>
                <div class="mt-3 position-relative">
                    <input type="tel" name="phone" class="field" placeholder="شماره تلفن ...">
                    <i class="fa fa-user field_icon"></i>
                </div>
                <div class="mt-3 position-relative">
                    <input type="password" name="password" class="field" id="fieldPass" placeholder="رمز عبور ...">
                    <i class="fa fa-lock field_icon"></i>
                    <button type="button" id="showPass"></button>
                </div>
                <div class="mt-3">
                    <button type="submit" name="submit" class="btn-submit bg-primary">
                        <i class="fa fa-sign-in ms-1"></i>
                        <span>ورود به حساب کاربری</span>
                    </button>
                </div>

                <p class="text">
                    حساب کاربری ندارید ؟ <a href="/register.html" class="text-primary">یکی بسازید</a>
                </p>
            </form>
        </div>
    </section>

    <script src="js/showPassword.js"></script>
    <script src="js/darkMode.js"></script>
    <script src="js\jquery-3.6.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <?php if ($errorUserNotFound) { ?>

        <script>
            toastr.error("No account was found with this phone number.!");
        </script>

    <?php } ?>
    <?php if ($errorEmpty) { ?>

        <script>
            toastr.error("FILL THE FORM!");
        </script>

    <?php } ?>
    <?php if ($errorNotValidPhone) { ?>

        <script>
            toastr.error("YOUR PHONE NUMBER IS NOT VALID !");
        </script>

    <?php } ?>
    <?php if ($errorIncorect) { ?>

        <script>
            toastr.error("YOUR PASSWORD OR PHONE IS INCORRECT !");
        </script>

    <?php } ?>
    <?php if ($errorStatus) { ?>

        <script>
            toastr.error("YOUR ACCOUNT HAS NOT BEEN ACTIVATED !");
        </script>

    <?php } ?>
</body>

</html>