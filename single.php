<?php
include "./database/jdf.php";
include "./database/pdo_connection.php";

session_start();

$errorReapeted = false;
$success = false;

// $getID = $_GET['id'];   //course ID

if (!isset($_GET['id'])) {
    die("Invalid Course");
}

$courseID = (int) $_GET['id'];

$result = $conn->prepare("SELECT * FROM episodes WHERE course=?");
$result->bindValue(1, $courseID);
$result->execute();

$episodes = $result->fetchAll(PDO::FETCH_ASSOC);

$result = $conn->prepare("SELECT * FROM courses WHERE id=?");
$result->bindValue(1, $courseID);
$result->execute();

$courses = $result->fetch(PDO::FETCH_ASSOC);

$count = 1;

if (isset($_POST['add'])) {

    $result = $conn->prepare("SELECT * FROM `shopcard` WHERE id_user=? AND id_course=? ");
    $result->bindValue(1, $_SESSION['id']);
    $result->bindValue(2, $courseID);
    $result->execute();
    if ($result->rowCount() >= 1) {
        $errorReapeted = true;
    } else {
        $result = $conn->prepare("INSERT INTO shopcard SET id_user=?, id_course=?");
        $result->bindValue(1, $_SESSION['id']);
        $result->bindValue(2, $courseID);
        $result->execute();

        $success = true;
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
    <!-- Css Reset -->
    <link rel="stylesheet" href="styles/css/reset.css">
    <!-- NavBar Style -->
    <link rel="stylesheet" href="styles/css/nav.css">
    <!-- Footer Style -->
    <link rel="stylesheet" href="styles/css/footer.css">
    <!-- Main Css -->
    <link rel="stylesheet" href="styles/css/single.css">
    <!-- Vazir Font -->
    <link rel="stylesheet" href="fonts/vazir.css">
    <!-- Fontawsome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>پست</title>
</head>

<body>
    <div class="modal fade" id="modalSearchBox">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="#" class="position-relative">
                    <input type="search" placeholder="جستجو ..." class="form-control searchField">
                    <button class="searchBtn"><i class="fas fa-search fs-6"></i></button>
                </form>
            </div>
        </div>
    </div>


    <nav class="navMenu navbar navbar-dark navbar-expand-lg align-items-center bg-primary fixed-top">
        <div class="container flex-row-reverse">
            <div class="d-flex align-items-center">
                <button type="button" class="search-icon" data-bs-toggle="modal" data-bs-target="#modalSearchBox">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
                <button id="switchTheme"></button>
                <a class="navbar-brand text-white fw-bold fs-5" href="/index.html"><img src="https://codeyad.com/assets/images/logo.png?v=LeGU9ZpNcH1zdFN4EVqXRwoS_Iaehq3X46AqXt2uWPk" alt="Codeyad"></a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
                <i class="fas fa-bars fs-3"></i>
            </button>


            <div class="collapse navbar-collapse right-nav justify-content-start" id="navbar">
                <ul class="navbar-nav nav-left">
                    <li class="nav-item me-0">
                        <a class="nav-link mt-3 mt-lg-0" href="/index.html">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>خانه</span>
                        </a>
                    </li>
                    <li class="nav-item me-0">
                        <a class="nav-link mt-3 mt-lg-0" href="/posts.html">
                            <i class="fas fa-list"></i>
                            <span>پست ها</span>
                        </a>
                    </li>

                    <li class="nav-item me-0">
                        <a class="nav-link mt-3 mt-lg-0" href="/login.html">
                            <i class="fa fa-sign-in ms-1"></i>
                            <span>ورود</span>
                        </a>
                    </li>

                    <li class="nav-item me-0">
                        <a class="nav-link mt-3 mt-lg-0" href="/register.html">
                            <i class="fa fa-user-plus ms-1"></i>
                            <span>عضویت</span>
                        </a>
                    </li>
                </ul>
            </div>


        </div>
    </nav>
    <div class="content bg-white col-8">

    </div>

    <main style="margin-top: 10rem; margin-bottom: 5rem;">

        <div class="me-5">
            <!-- Stack the columns on mobile by making one full-width and the other half-width -->
            <div class="row">
                <div class="content col-md-3 ">

                    <div class="teacherprofile mt-3 py-1 px-4 shadow p-3 mb-5 bg-body  rounded">

                        <div class="d-flex align-items-center justify-content-between  pt-0">
                            <img src="https://codeyad.com/assets/images/online-learning.png" style="width:70px;" alt="">
                            <div>
                                مدرس :
                                <a href="">حسین عنایتی</a>
                            </div>
                        </div>
                        <hr>
                        <div class="coursedescription pb-3">
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p class="text-muted">قیمت</p>
                                <p class="text-success fw-bold"> تومان 500</p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p class="text-muted">تعداد قسمت ها</p>
                                <p class="fw-bold">132</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p class="text-muted">وضعیت دوره</p>
                                <p class="text-success fw-bold">درحال برگزاری</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p class="text-muted">سطح دوره</p>
                                <p class=" fw-bold">از مقدماتی تا پیشرفته</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p class="text-muted">آخرین بروزرسانی</p>
                                <p class=" fw-bold"><?= jdate('Y/m/d'); ?></p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">

                                <form method="post">
                                    <input class="btn btn-success add-butt login-in-dore login-in-dore-hover me-5 " type="submit" name="add" value="ثبت نام در این دوره">
                                </form>
                            </div>

                        </div>

                    </div>

                    <div class="shadow p-3 mb-5 bg-body rounded">
                        برچسب ها :

                        <hr>
                        <div class="">
                            <div class=""><a class="" href="">یادگیری برنامه نویسی</a>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="content col-6 col-md-8 bg-white me-3">



                    <h4 class="title mb-4"> <?= $courses['title']; ?> </h4>
                    <div class="img w-100 bg-black">
                        <video controls poster="images/my-poster.jpg" width="100%">
                            <source src="./PANEL/uploads/movies/<?= $courses['introduction'] ?>" type="video/mp4">
                        </video>

                    </div>
                    <div class="mt-5">
                        <p>

                            <?= $courses['caption']; ?>

                        </p>
                    </div>



                </div>

            </div>
            <div class="row mt-2">
                <div class="content col-md-3  ">
                </div>


                <div class="content col-6 col-md-8 bg-white me-3">


                    <h4 class="title mb-4"> بخش های دوره</h4>
                    <div class="img w-100 bg-black">
                    </div>


                    <?php foreach ($episodes as $episode) { ?>
                        <div class="p-3 bg-info bg-opacity-10 border border-info rounded-end mt-2">
                            <div class="course-unit-item p-2  align-items-center">
                                <div>
                                    <span class="counter"><?= $count++; ?></span>
                                    <h3 class="episodeTitle d-inline"><?= $episode['title'] ?> </h3>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <a href="./PANEL/uploads/images/<?= $episode['file']; ?>">
                                    <div class="d-flex align-items-center justify-content-center cursor-pointer receive mb-1">
                                        <i class="fas fa-download pl-1 ms-1"></i>
                                        <p>دریافت فایل</p>
                                    </div>
                                </a>
                                <a href="./PANEL/uploads/movies/<?= $episode['video']; ?>">
                                    <div class="d-flex align-items-center justify-content-center cursor-pointer play mb-1">
                                        <i class="fas fa-play pl-1 ms-1"></i>
                                        <p> دریافت ویدیو </p>
                                    </div>
                                </a>
                                <div class="d-flex align-items-center justify-content-center cursor-pointer askAnswer mb-1">
                                    <p><?= $episode['time'] ?> </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                </div>


            </div>



    </main>


    <footer class="footer">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <p class="fw-bold text-white mb-3 mb-md-0 fs-6">تمامی حقوق برای کدیاد محفوظ می باشد &copy;</p>
            <button type="button" id="scrollUpBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                </svg>
            </button>
        </div>
    </footer>



    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/scrollToUp.js"></script>
    <script src="js/darkMode.js"></script>
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <?php if ($errorReapeted) { ?>

        <script>
            toastr.error("you have already sighned up!");
        </script>

    <?php } ?>

    <?php if ($success) { ?>

        <script>
            toastr.success("thank you!");
        </script>

    <?php } ?>

</body>

</html>