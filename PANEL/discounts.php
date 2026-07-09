<?php
include "../database/pdo_connection.php";
include "header.php";

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $code = $_POST['code'];
    $percent = $_POST['percent'];
    $result = $conn->prepare("INSERT INTO discounts SET title=?,code=?,percent=?");
    $result->bindValue(1, $title);
    $result->bindValue(2, $code);
    $result->bindValue(3, $percent);
    $result->execute();
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>menu</title>
</head>

<body>
    <section class="main" :class="open || 'active'">
        <div class="container pt-5">
            <div class="card card-primary bg-light shadow p-4 ">
                <h1 class="text-gray h4 fw-bold">
                    <i class="bi bi-plus-circle"></i>
                    <span>افزودن کد تخفیف</span>
                </h1>
                <form action="#" class="mt-4" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="text-gray-600 fw-bold">عنوان کد تخفیف </label>
                            <input name="title" id="name" type="text" class="form-control mt-2" />
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="text-gray-600 fw-bold">  درصد کد تخفیف </label>
                            <input name="percent" id="name" type="text" class="form-control mt-2" />
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="category" class="text-gray-600 fw-bold"> کد تخفیف  </label>
                            <input type="text" name="code" class="form-control mt-2">
                        </div>

                    </div>
                    <br><br><br>
                    <input type="submit" name="submit" value="افزودن" class="btn btn-success">

                </form>


    </section>

</body>

</html>