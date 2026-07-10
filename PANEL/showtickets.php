<?php
include "../database/pdo_connection.php";
include "../database/jdf.php";
session_start();
include "header.php";


if ($_SESSION['role'] == 3) {
    $result = $conn->prepare("SELECT * FROM tickets WHERE reply=0 ORDER BY id DESC");
    $result->execute();
    $tickets_admin_list = $result->fetchAll(PDO::FETCH_ASSOC);
} elseif ($_SESSION['role'] == 1) {
    $result = $conn->prepare("SELECT * FROM tickets WHERE sender=? AND reply=0 ORDER BY id DESC");
    $result->bindValue(1, $_SESSION['id']);
    $result->execute();
    $tickets_user_list = $result->fetchAll(PDO::FETCH_ASSOC);
}



$count = 1;
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تیکت ها </title>
</head>

<body>
    <section class="main" :class="open || 'active'">
        <div class="container pt-5">
            <div class="card card-primary bg-light shadow p-4 ">
                <table class="table">
                    <thead>
                        <tr class="table-info ">
                            <th scope="col">#</th>
                            <th scope="col">عنوان </th>
                            <th scope="col"> تاریخ </th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($_SESSION['role'] == 3) {
                            foreach ($tickets_admin_list as $admin) { ?>
                                <tr>
                                    <td><?= $count++; ?></td>
                                    <td><?= $admin['title']; ?></td>
                                    <td><?= jdate("Y/m/d/h:i:s", $admin['time']); ?></td>
                                    <td><a href="./answerticket.php?main=<?= $admin['id']; ?>" class="btn btn-warning mx-2">ورود</a></td>
                                </tr>
                            <?php }
                        } elseif ($_SESSION['role'] == 1) {
                            foreach ($tickets_user_list as $user) { ?>

                                <tr>
                                    <td><?= $count++; ?></td>
                                    <td><?= $user['title']; ?></td>
                                    <td><?= jdate("Y/m/d/h:i:s", $user['time']); ?></td>
                                    <td><a href="./answerticket.php?main=<?= $user['id']; ?>" class="btn btn-warning mx-2">ورود</a></td>
                                </tr>


                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</body>

</html>