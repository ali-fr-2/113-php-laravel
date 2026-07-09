<?php

include "../database/pdo_connection.php";
session_start();

include "header.php";

$count = 1;

$total = 0;

$ID = $_SESSION['id'];

$result = $conn->prepare("SELECT shopcard.id, courses.title, courses.image, courses.price FROM `shopcard`
 JOIN `courses` ON shopcard.id_course=courses.id WHERE shopcard.id_user=? AND shopcard.status=? 
 ");
$result->bindValue(1, $ID);
$result->bindValue(2, 0);
$result->execute();
$items = $result->fetchAll(PDO::FETCH_ASSOC);

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
        <h1 class="text-gray h4 fw-bold">
          <i class="bi bi-basket-fill"></i>
          <span> سبد خرید </span>
        </h1>
        <table class="table">
          <thead>
            <tr class="table-primary">
              <th scope="col">#</th>
              <th scope="col">نام دوره </th>
              <th scope="col"> عکس دوره </th>
              <th scope="col">قیمت دوره </th>
              <th scope="col"> عملیات </th>
            </tr>
          </thead>
          <tbody>


            <?php foreach ($items as $item) { ?>
              <tr>
                <th scope="row"><?= $count++; ?></th>
                <td><?= $item['title']; ?></td>
                <td><img src="./uploads/images/<?= $item['image'] ?>" style="height: 80px;" alt=""></td>
                <td><?= $item['price']; ?></td>
                <td> <a href="#" class="btn btn-danger"> حدف از سبد</a></td>
              </tr>
            <?php $total += $item['price'];
            }; ?>
          </tbody>
        </table>

        <?php

        if (isset($_POST['discount'])) {
          $code = $_POST['code'];
          $result = $conn->prepare("SELECT * FROM `discounts` WHERE code=?");
          $result->bindValue(1,$code);
          $result->execute();
          $discounts = $result->fetch(PDO::FETCH_ASSOC);

          if ($discounts) {
            $numbercode=$discounts['percent'];
            $total=(100-$numbercode)*($total/100);
          } else {
            echo "چنین کد تخفیفی موجود نیست!";
          }
        }
        ?>


        <form action="" method="post">
          <input class="form-control mb-2" type="text" name="code" style="width: 250px;">
          <input class="btn btn-success mb-2" type="submit" name="discount" value="اعمال کد تخفیف  ">
        </form>
        <div class="alert alert-dark fs-3"> مجموع مبلغ سبد خرید شما : <span class=" text text-success fs-3"><?= $total; ?></span></div>

        <div>
          <form action="shopping.php" method="post">
            <input class="btn btn-primary" type="submit" name="shopping" value="پرداخت سبد خرید">
            <input type="hidden" name="total" value="<?= $total ?>">
          </form>
        </div>

      </div>

    </div>
  </section>
</body>

</html>