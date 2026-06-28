<?php
include "header.php";

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
              
              <span>افزودن پست</span>
            </h1>
            <form action="#" class="mt-4" method="POST">
              <div class="row">
                <div class="col-md-6">
                  <label for="name" class="text-gray-600 fw-bold"
                    >نام پست</label
                  >
                  <input name="title" id="name" type="text" class="form-control mt-2" />
                </div>
                <div class="col-md-6">
                  <label for="name" class="text-gray-600 fw-bold"
                    > لینک عکس</label
                  >
                  <input name="image" id="name" type="text" class="form-control mt-2" />
                </div>
              </div>

              <div class="mt-4">
                <label for="text" class="text-gray-600 fw-bold">متن پست</label>
                <textarea
                name="caption"
                  id="text"
                  class="form-control mt-2"
                  cols="30"
                  rows="10"
                ></textarea>
              </div>

              <div class="row mt-4">
                <div class="col-md-6">
                  <label for="category" class="text-gray-600 fw-bold"
                    > نویسنده</label
                  >
                  <select name="writer" class="form-select mt-2" id="category">
                    <option value="1"> میرراد</option>
                   
                  </select>
                </div>
               
              </div>
</section>
</body>
</html>