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

// حواستون به مسیر برای فایل پروژه باشه دقیقا مثل جلسات قبلی  عمل بکنید و موفق باشید 
if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $caption = $_POST['caption'];
  $image = $_FILES['image'];
  $introduction_file = $_FILES['video'];
  $price = $_POST['price'];
  $category = $_POST['category'];
  $level = $_POST['level'];
  $status = $_POST['status'];
  $tag = $_POST['tag'];
  $teacher=$_POST['teacher'];

  $extension_image = pathinfo($image['name'], PATHINFO_EXTENSION);

  $newName_image = uniqid() . "." . $extension_image;

  $tmp_image = $image['tmp_name'];

  // move_uploaded_file($tmp_image, "uploads/images/" . $newName_image);
  if (!move_uploaded_file($tmp_image, "uploads/images/" . $newName_image)) {
    die("Image Upload Failed");
  }

  $extension_video = pathinfo($introduction_file['name'], PATHINFO_EXTENSION);

  $newName_video = uniqid() . "." . $extension_video;

  $tmp_video = $introduction_file['tmp_name'];

  // move_uploaded_file($tmp_video, "uploads/movies/" . $newName_video);
  if (!move_uploaded_file($tmp_video, "uploads/movies/" . $newName_video)) {
    die("Image Upload Failed");
  }

  $result = $conn->prepare("INSERT INTO courses SET title=?, caption=?, image=?,	introduction=?,	price=?, category=?,	level=?,	status=?, tag=?,teacher=?, create_date=? ");
  $result->bindValue(1, $title);
  $result->bindValue(2, $caption);
  $result->bindValue(3, $newName_image);
  $result->bindValue(4, $newName_video);
  $result->bindValue(5, $price);
  $result->bindValue(6, $category);
  $result->bindValue(7, $level);
  $result->bindValue(8, $status);
  $result->bindValue(9, $tag);
  $result->bindValue(10, $teacher);
  $result->bindValue(11, time());

  $result->execute();
}
$result = $conn->prepare("SELECT * FROM menus");
$result->execute();
$menus = $result->fetchAll(PDO::FETCH_ASSOC);

$result = $conn->prepare("SELECT * FROM users");
$result->execute();
$users = $result->fetchAll(PDO::FETCH_ASSOC);


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
          <span>افزودن دوره </span>
        </h1>
        <form id="upload-form" action="" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-6">
              <label for="name" class="text-gray-600 fw-bold">نام دوره</label>
              <input name="title" id="name" type="text" class="form-control mt-2" />
            </div>
            <div class="col-md-6">
              <label for="name" class="text-gray-600 fw-bold"> دوره عکس</label>
              <input type="file" name="image" id="fileToUpload" class="form-control mt-2" />
            </div>
          </div>

          <div class="mt-4">
            <label name="caption" for="text" class="text-gray-600 fw-bold"> توضیحات دوره</label>
            <textarea
              name="caption"
              id="text"
              class="form-control mt-2"
              cols="30"
              rows="10"></textarea>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <label for="name" class="text-gray-600 fw-bold">
                ویدیو معرفی</label>
              <input type="file" name="video" id="fileToUpload" class="form-control mt-2" />
            </div>
            <div class="col-md-6">
              <label for="name" class="text-gray-600 fw-bold">
                قیمت دوره</label>
              <input name="price" id="name" type="text" class="form-control mt-2" />
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <label for="name" class="text-gray-600 fw-bold"> دسته بندی</label>

              <select name="category" class="form-control">

                <?php foreach ($menus as $menu) { ?>

                  <option value="<?= $menu['id'] ?>"> <?= $menu['title'] ?> </option>

                <?php } ?>

              </select>
            </div>
            <div class="col-md-6">
              <label for="name" class="text-gray-600 fw-bold"> سطح دوره</label>
              <select name="level" class="form-control">
                <option value="1">مقدماتی</option>
                <option value="2">پیشرفته</option>
                <option value="3">مقدماتی تا پیشرفته</option>
              </select>
            </div>
          </div>
          <br>
          <label for="name" class="text-gray-600 fw-bold">وضعیت دوره</label><br>
          <label> به پایان رسیده</label>
          <input type="radio" name="status" value="1">
          <label>درحال برگزاری</label>
          <input type="radio" name="status" value="0" checked>
          <br>
          <br>

          <div class="row">
            <div class="col-md-6">
              <label for="name" class="text-gray-600 fw-bold"> مدرس دوره </label>

              <select name="teacher" class="form-control">

                <?php foreach ($users as $user) {
                  if ($user['role'] == 2 || $user['role'] === 3) {
                ?>
                    <option value="<?= $user['id'] ?>"> <?= $user['username'] ?> </option>
                <?php }
                } ?>

              </select>
            </div>
            <div class="col-md-6">
              <label for="name" class="text-gray-600 fw-bold">
                برچسب</label>
              <input type="text" name="tag" id="fileToUpload" class="form-control mt" />
            </div>


          </div>
          <br>

          <input type="submit" name="submit" value=" افزودن دوره" class="btn btn-success">

        </form>

      </div>
    </div>

  </section>

</body>

</html>