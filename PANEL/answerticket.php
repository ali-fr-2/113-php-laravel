<?php
include "../database/pdo_connection.php";
include "../database/jdf.php";
session_start();
include "header.php";


$result = $conn->prepare("SELECT tickets.*, users.username, users.role 
FROM tickets LEFT JOIN users ON tickets.sender=users.id 
WHERE main=? ORDER BY id ASC
");
$result->bindValue(1, $_GET['main']);
$result->execute();
$tickets = $result->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['submit'])) {
  $caption = $_POST['caption'];
  $result = $conn->prepare("INSERT INTO tickets SET title=? ,caption=?,sender=?,reply=?,main=?,time=? ");
  $result->bindValue(1, "");
  $result->bindValue(2, $caption);
  $result->bindValue(3, $_SESSION['id']);
  $result->bindValue(4, $_GET['main']);
  $result->bindValue(5, $_GET['main']);
  $result->bindValue(6, time());
  $result->execute();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>
  .admin{
    background-color: aqua;
  }
  .user{
    background-color:  gray;
  }
</style>

<body>
  <section class="main" :class="open || 'active'">
    <div class="container pt-5">
      <div class="card card-primary bg-light shadow p-4 ">
        <div class="row">
          <!-- صفحه چت -->
          <?php foreach ($tickets as $ticket) { ?>

            <div class="col-md-8 <?php if($ticket['role']==3){?> admin <?php }else{?>user <?php }?> " style=" height :45px; padding:5px; ">

              <span class="d-inline-block mx-5"> <?= $ticket['username']; ?> </span>
              <?= $ticket['caption']; ?>


              <br><br><br>
            </div>

          <?php } ?>

          <br>
          <br>
          <br>


          <form action="#" class="mt-4" method="POST">
            <div class="row">
              <div class="col-md-6">
                <label for="name" class="text-gray-600 fw-bold"> پاسخ به تیکت </label>
                <input name="caption" id="name" type="text" class="form-control mt-2" />
              </div>

            </div>



            <br><br><br>
            <input type="submit" name="submit" value="افزودن" class="btn btn-success">

          </form>


  </section>

</body>

</html>