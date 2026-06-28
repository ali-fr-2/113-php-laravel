<?php
include "database/pdo_connection.php";
$errorvalidation = "";
if (isset($_GET['validation'])) {
    $validation = $_GET['validation'];
    $check = $conn->prepare("SELECT id FROM users WHERE validation=?");
    $check->bindValue(1, $validation);
    $check->execute();

    if ($check->rowCount() > 0) {

        $update = $conn->prepare("UPDATE users SET status=? WHERE validation=?");
        $update->bindValue(1, 1);
        $update->bindValue(2, $validation);
        $update->execute();

        header("Location:index.php");
        exit;
    } else {

        $errorvalidation = true;
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
    <!-- CDN toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>اعتبار سنجی </title>
</head>

<body>
    <section class="d-flex justify-content-center align-items-center min-h-screen bg">
        <div id="overlay"></div>
        <div class="form-container">
            <form action="#" method="GET">



                <h1 class="title"> کد تایید را وارد بکنید </h1>
                <div class="mt-3 position-relative">
                    <input name="validation" type="number" class="field" placeholder="کد تایید را وارد بکنید ...">
                    <i class="fa fa-key field_icon"></i>
                </div>
                <div class="mt-3">
                    <button name="sub" type="submit" class="btn-submit bg-primary">
                        <i class="fa fa-key ms-1"></i>
                        <span>ارسال کد </span>
                    </button>
                </div>

                <p class="text">
                    قبلا ثبت نام کرده اید ؟ <a href="/login.html" class="text-primary">ورود</a>
                </p>
            </form>
        </div>
    </section>

    <script src="js/showPassword.js"></script>
    <script src="js/darkMode.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js\jquery-3.6.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <?php if (isset($_GET['success']) && $_GET['success']) { ?>
        <script>
            toastr.success('کد فعال سازی برای شما ارسال شد    ');
        </script>
    <?php } ?>

    <?php if ($errorvalidation) { ?>
        <script>
            toastr.error('کد فعال سازی اشتباه هست       ');
        </script>
    <?php } ?>

</body>

</html>