<?php

include "./auth.php";
include "header.php";
include "../database/pdo_connection.php";
include "../database/jdf.php";

$result = $conn->prepare("SELECT * FROM courses");
$result->execute();
$courses = $result->fetchAll(PDO::FETCH_ASSOC);
$count = 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>showCourse</title>
</head>

<body>
    <section class="main" :class="open || 'active'">
        <div class="container pt-5">
            <div class="card card-primary bg-light shadow p-4 ">
                <h1 class="text-gray h4 fw-bold">
                    <i class="bi bi-plus-circle"></i>
                    <span>نمایش دوره ها  </span>
                </h1>
                <table class="table">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">#</th>
                            <th scope="col"> نام دوره</th>
                            <th scope="col">عکس دوره </th>
                            <th scope="col">قیمت دوره </th>
                            <th scope="col">تاریخ ثبت</th>
                            <th scope="col">تاریخ به روزرسانی</th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course) { ?>
                            <tr>
                                <td><?= $count++; ?></td>
                                <td><?= $course['title']; ?></td>
                                <td>
                                    <img src="./uploads/images/<?= $course['image'] ?>" style="width: 40px;" alt="">
                                </td>
                                <td><?= $course['price']; ?></td>
                                <td><?= jdate('Y/m/d/h:i:s',$course['create_date']); ?></td>
                                <td><?= jdate('Y/m/d/h:i:s',$course['update_date']); ?></td>
                                <td><a href="./editmenu.php?id=<?= $course['id'] ?>" class="btn btn-warning mx-2">ویرایش</a><a href="./deletemenu.php?id=<?= $course['id'] ?>" class="btn btn-danger">حذف</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</body>

</html>