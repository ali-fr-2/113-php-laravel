<?php
include "./auth.php";
include "header.php";
include "../database/pdo_connection.php";

$result = $conn->prepare("SELECT * FROM users");
$result->execute();
$users = $result->fetchAll(PDO::FETCH_ASSOC);
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
                        <tr class="table-primary">
                            <th scope="col">#</th>
                            <th scope="col"> نام کاربری</th>
                            <th scope="col"> سطح کاربری </th>
                            <th scope="col">شماره تلفن </th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td><?= $count++; ?></td>
                                <td><?= $user['username']; ?></td>
                                <td>
                                    <?php
                                    if ($user['role'] == 3) {
                                        echo '<span class="badge bg-danger p-2">KING</span>';
                                    } else if ($user['role'] == 2) {
                                         echo '<span class="badge bg-warning p-2">MASTER</span>';
                                    } elseif ($user['role'] == 1) {
                                        echo " user ";
                                    }
                                    ?>
                                </td>
                                <td><?= $user['phone']; ?></td>
                                <td><a href="./edituser.php?id=<?= $user['id'] ?>" class="btn btn-warning mx-2">ویرایش</a><a href="./deleteuser.php?id=<?= $user['id'] ?>" class="btn btn-danger">حذف</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</body>

</html>