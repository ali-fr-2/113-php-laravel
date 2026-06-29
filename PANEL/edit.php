<?php

include "../database/pdo_connection.php";
include "header.php";

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $parent = $_POST['parent'];
    $sort = $_POST['sort'];
    $result = $conn->prepare("UPDATE menus SET title=?,parent=?,sort=? WHERE id=?");
    $result->bindValue(1, $title);
    $result->bindValue(2, $parent);
    $result->bindValue(3, $sort);
    $result->bindValue(4, $_GET['id']);
    $result->execute();
    // header("location:showmenu.php");  // this aint work
}
$stmt = $conn->prepare("SELECT * FROM menus");
$stmt->execute();
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

$user = $conn->prepare("SELECT * FROM menus WHERE id=?");
$user->bindValue(1, $_GET['id']);
$user->execute();

$item = $user->fetch(PDO::FETCH_ASSOC);

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
                    <span>ویرایش منو</span>
                </h1>
                <form action="#" class="mt-4" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="text-gray-600 fw-bold">عنوان منو </label>
                            <input name="title" id="name" type="text" class="form-control mt-2" value="<?= $item['title']; ?>" />
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="text-gray-600 fw-bold"> اولویت بندی </label>
                            <input name="sort" id="name" type="text" class="form-control mt-2" value="<?= $item['sort']; ?>" />
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="category" class="text-gray-600 fw-bold"> والد یا سرگروه</label>
                            <select name="parent" class="form-select mt-2" id="category">
                                <option value="0">بدون والد</option>
                                <?php foreach ($menus as $menu) { ?>
                                    <?php if ($menu['id'] != $item['id']) { ?>
                                        <option <?php if ($menu['id'] == $item['parent']) { ?> selected <?php } ?> value="<?= $menu['id']; ?>"><?= $menu['title']; ?></option>
                                <?php }
                                }; ?>
                            </select>
                        </div>

                    </div>
                    <br><br><br>
                    <input type="submit" name="submit" value="افزودن" class="btn btn-success">

                </form>


    </section>

</body>

</html>