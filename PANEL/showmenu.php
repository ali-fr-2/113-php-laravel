<?php

include "header.php";
include "../database/pdo_connection.php";

$result = $conn->prepare("SELECT * FROM menus");
$result->execute();
$menus = $result->fetchAll(PDO::FETCH_ASSOC);
$count=1;

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
            <tr class="table-danger">
              <th scope="col">#</th>
              <th scope="col">عنوان منو</th>
              <th scope="col">والد یا سرگروه</th>
              <th scope="col">اولویت بندی</th>
              <th scope="col">عملیات</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($menus as $menu) { ?>
              <tr>
                <td><?= $count++;?></td>
                <td><?= $menu['title'];?></td>
                <td>
                  <?php 
                  if($menu['parent']==0){
                    echo "بدون والد ";
                  }else{
                    foreach($menus as $parent){
                      if($parent['id']==$menu['parent']){
                        echo $parent['title'];
                        break;
                      }
                    }
                  }
                  ?>
                </td>
                <td><?= $menu['sort'];?></td>
                <td><a href="./edit.php" class="btn btn-warning mx-2">ویرایش</a><a href="./delete.php" class="btn btn-danger">حذف</a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

    </div>
  </section>
</body>

</html>