<?php
include "../database/pdo_connection.php";
include "header.php";

$result = $conn->prepare("SELECT * FROM discounts");
$result->execute();
$discounts = $result->fetchAll(PDO::FETCH_ASSOC);
$count = 1;
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section class="main" :class="open || 'active'">
        <div class="container pt-5">
            <div class="card card-primary bg-light shadow p-4 ">
                <table class="table">
                    <thead>
                        <tr class="table-info ">
                            <th scope="col">#</th>
                            <th scope="col">عنوان کد تخفیف </th>
                            <th scope="col">درصد کد نخفیف  </th>
                            <th scope="col">کد تخفیف </th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($discounts as $discount) { ?>
                            <tr>
                                <td><?= $count++; ?></td>
                                <td><?= $discount['title']; ?></td>
                                <td><?= $discount['percent'] ?></td>
                                <td><?= $discount['code']; ?></td>
                                <td><a href="./editmenu.php?id=<?= $discount['id'] ?>" class="btn btn-warning mx-2">ویرایش</a><a href="./deletemenu.php?id=<?= $discount['id'] ?>" class="btn btn-danger">حذف</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</body>

</html>