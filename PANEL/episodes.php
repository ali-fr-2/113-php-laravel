<?php

// if (isset($_POST['submit']) && !empty($_FILES["fileToUpload"]["tmp_name"])) {
//     $target_dir = "uploads/";
//     $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//     $uploadOk = 1;
//     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//     $message = array();
// // Check if image file is a actual image or fake image


// // Check if file already exists
//     if (file_exists($target_file)) {
//         $message[] = "با عرض پوزش ، پرونده از قبل وجود دارد.";
//         $uploadOk = 0;
//     }

// // Check file size
//     if ($_FILES["fileToUpload"]["size"] > 5000000000) {
//         $message[] = "با عرض پوزش ، پرونده شما بسیار بزرگ است.";
//         $uploadOk = 0;
//     }

// // Allow certain file formats
//     if ($imageFileType != "mp4" ) {
//         $message[] = "متاسفیم فرمت فایل شما باید JPG, JPEG, PNG & GIF باشد.";
//         $uploadOk = 0;
//     }

// // Check if $uploadOk is set to 0 by an error
//     if ($uploadOk == 0) {
//         $message[] = "متاسفانه فایل شما به درستی آپلود نشد!";

// // if everything is ok, try to upload file
//     } else {
//         if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//             $message[] = "فایل شما با نام " . basename($_FILES["fileToUpload"]["name"]) . "به خوبی آپلود شد.";
//         } else {
//             $message[] = "متأسفیم ، هنگام بارگذاری پرونده شما خطایی رخ داد.";
//         }
//     }
// }
include "../database/pdo_connection.php";

include "header.php";

$courseID = $_GET['id'];

// حواستون به مسیر برای فایل پروژه باشه دقیقا مثل جلسات قبلی  عمل بکنید و موفق باشید 
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $introduction_file = $_FILES['video'];
    $myfile = $_FILES['myfile'];
    $time = $_POST['time'];
    $courseID = $_POST['id'];
    $status = $_POST['status'];


    $extension_file = pathinfo($myfile['name'], PATHINFO_EXTENSION);

    $newName_file = uniqid() . "." . $extension_file;

    $tmp_file = $myfile['tmp_name'];

    // move_uploaded_file($tmp_image, "uploads/images/" . $newName_image);
    if (!move_uploaded_file($tmp_file, "uploads/images/" . $newName_file)) {
        die("Image Upload Failed");
    }

    $extension_video = pathinfo($introduction_file['name'], PATHINFO_EXTENSION);

    $newName_video = uniqid() . "." . $extension_video;

    $tmp_video = $introduction_file['tmp_name'];

    // move_uploaded_file($tmp_video, "uploads/movies/" . $newName_video);
    if (!move_uploaded_file($tmp_video, "uploads/movies/" . $newName_video)) {
        die("Image Upload Failed");
    }

    $result = $conn->prepare("INSERT INTO episodes SET title=?, time=?, status=?, course=?,	video=?, file=?");
    $result->bindValue(1, $title);
    $result->bindValue(2, $time);
    $result->bindValue(3, $status);
    $result->bindValue(4, $courseID);
    $result->bindValue(5, $newName_video);
    $result->bindValue(6, $newName_file);
    $result->execute();
}

$result = $conn->prepare("SELECT * FROM courses WHERE id=?");
$result->bindValue(1, $courseID);
$result->execute();
$courses = $result->fetch(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>course</title>
</head>

<body>
    <section class="main" :class="open || 'active'">
        <div class="container pt-5">
            <div class="card card-primary bg-light shadow p-4 ">
                <h1 class="text-gray h4 fw-bold">
                    <i class="bi bi-plus-circle"></i>
                    <span> افزودن بخش جدید => <?php echo $courses['title']; ?> </span>
                </h1>
                <form id="upload-form" action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="text-gray-600 fw-bold"> عنوان بخش (فارسی) :</label>
                            <input name="title" id="name" type="text" class="form-control mt-2" />
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="text-gray-600 fw-bold"> ویدیو مربوط به این بخش پسوند مجاز <span style="color:red ;">(.mp4) </span> </label>
                            <input type="file" name="video" id="fileToUpload" class="form-control mt-2" />
                        </div>
                    </div>


                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="text-gray-600 fw-bold"> فایل : پسوند مجاز <span style="color:red ;">(.zip , .rar)</span> اجباری نمی باشد </label>
                            <input type="file" name="myfile" id="fileToUpload" class="form-control mt-2" />
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="text-gray-600 fw-bold"> زمان این بخش</label>
                            <input name="time" id="name" type="text" class="form-control mt-2" placeholder="مثال 00:15:00" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="text-gray-600 fw-bold"> آی دی دوره</label>
                            <br>

                            <input name="id" id="name" type="text" class="form-control mt-2 " value="<?php echo $courses['id'] ?>" readonly />
                        </div>

                    </div>
                    <br>
                    <div>

                        <label for="name" class="text-gray-600 fw-bold">این بخش رایگان است ؟ : </label><br>
                        <label> رایگان </label>
                        <input type="radio" name="status" value="1">
                        <label>نقدی </label>
                        <input type="radio" name="status" value="0" checked>
                    </div>

                    <br>

                    <input type="submit" name="submit" value=" افزودن دوره" class="btn btn-success">

                </form>
            </div>
        </div>

    </section>

</body>

</html>