<?php
include "../database/pdo_connection.php";
session_start();
include "header.php";


$result=$conn->prepare("SELECT * FROM tickets ORDER BY id DESC LIMIT 1 ");
$result->execute();
$tickets=$result->Fetch(PDO::FETCH_ASSOC);

if($tickets){
  $tickets=$tickets['id']+1;
}else{
  $tickets=2;
}

if(isset($_POST['ticket'])){
    $title=$_POST['title'];
    $caption=$_POST['caption'];
    $reply=0;
    $result=$conn->prepare("INSERT INTO tickets SET title=? ,caption=?,sender=?,reply=?,main=?,time=? ");
    $result->bindValue(1,$title);
    $result->bindValue(2,$caption);
    $result->bindValue(3,$_SESSION['id']);
    $result->bindValue(4,$reply);
    $result->bindValue(5,$tickets);
    $result->bindValue(6,time());
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
<body>
<section class="main" :class="open || 'active'">
        <div class="container pt-5">
          <div class="card card-primary bg-light shadow p-4 ">
            <h1 class="text-gray h4 fw-bold">
              <i class="bi bi-plus-circle"></i>
              <span>افزودن تیکت</span>
          </h1>
            <form action="#" class="mt-4" method="POST">
            <div class="row">
                <div class="col-md-6">
                  <label for="name" class="text-gray-600 fw-bold"
                    >عنوان تیکت </label
                  >
                  <input name="title" id="name" type="text" class="form-control mt-2" />
                </div>
              </div>

            <div class="row mt-4">
                <div class="col-md-12">
                <label name="caption" for="text" class="text-gray-600 fw-bold"> متن پیام </label>
                <textarea
                name="caption"
                  id="text"
                  class="form-control mt-2"
                  cols="30"
                  rows="10"
                ></textarea>
                </div>
              </div>
            
             

       
              <br><br><br>
              <input type="submit" name="ticket" value="افزودن" class="btn btn-success">
          
</form>


</section>

</body>
</html>