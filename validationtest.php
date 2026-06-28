<?php

if (isset($_POST['phone'])) {

    $phone = $_POST['phone'];
    $code  = rand(100000, 999999);

    $username = urlencode("aliFR10");
    $password = urlencode("alifrALIFR10!)");
    $message  = urlencode("کد فعال سازی شما : " . $code);

    $url = "http://smspanel.Trez.ir/SendMessageWithCode.ashx?Username=$username&Password=$password&Mobile=$phone&Message=$message";

    $result = file_get_contents($url);

    echo $result;

    echo "<pre>";
    var_dump($result);
    echo "</pre>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="phone">
        <input type="submit" value="send">
    </form>
</body>

</html>