<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=codeyadproject", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
<!-- <div class="mt-3 position-relative">
                    <input  name="phone" type="number" class="field" placeholder="شماره تلفن ...">
                    <i class="bi bi-phone-fill field_icon" aria-hidden="true"></i>
                </div> -->