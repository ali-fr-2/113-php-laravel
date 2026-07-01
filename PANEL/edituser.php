<?php
include "./auth.php";
include "../database/pdo_connection.php";

if (!isset($_GET['id'])) {
    die("Invalid Request");
}

$user_selected = $conn->prepare("
SELECT id,username,phone,role
FROM users
WHERE id=?
");

$user_selected->bindValue(1, $_GET['id']);
$user_selected->execute();

$item = $user_selected->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    die("User Not Found");
}

if(isset($_POST['submit'])){

    $username=$_POST['username'];
    $phone=$_POST['phone'];

    // $role=$item['role'];

    if($_SESSION['role']==3){
        $role = (int)$_POST['role'];
        if (!in_array($role, [1,2])) {
        die("Invalid Role");
        }
    }else{
        $role=$item['role'];
    }

    $result=$conn->prepare("
    UPDATE users
    SET username=?, phone=?, role=?
    WHERE id=?
    ");

    $result->bindValue(1,$username);
    $result->bindValue(2,$phone);
    $result->bindValue(3,$role);
    $result->bindValue(4,$_GET['id']);

    $result->execute();

    header("Location: showusers.php");
    exit;
}
include "header.php";

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
</head>

<body>
    <section class="main" :class="open || 'active'">
        <div class="container pt-5">
            <div class="card card-primary bg-light shadow p-4 ">
                <h1 class="text-gray h4 fw-bold">
                    <i class="bi bi-plus-circle"></i>
                    <span>ویرایش کاربر</span>
                </h1>
                <form action="" class="mt-4" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="text-gray-600 fw-bold"> نام کاربری </label>
                            <input name="username" id="name" type="text" class="form-control mt-2" value="<?= $item['username']; ?>" />
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="text-gray-600 fw-bold"> تلفن </label>
                            <input name="phone" id="name" type="tel" class="form-control mt-2" value="<?= $item['phone']; ?>" />
                        </div>
                    </div>

                    <?php
                    if ($_SESSION['role'] == 3 && $_SESSION['id'] != $_GET['id']) { ?>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label for="category" class="text-gray-600 fw-bold"> سطح دسترسی </label>
                                <select name="role" class="form-select">

                                    <option value="1"
                                        <?= $item['role'] == 1 ? 'selected' : '' ?>>
                                        User
                                    </option>

                                    <option value="2"
                                        <?= $item['role'] == 2 ? 'selected' : '' ?>>
                                        Master
                                    </option>

                                </select>
                            </div>
                        </div>
                    <?php } ?>


                    <br><br><br>
                    <input type="submit" name="submit" value="افزودن" class="btn btn-success">

                </form>


    </section>

</body>

</html>