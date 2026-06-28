<?php

if (isset($_POST['phone'])) {

    $phone_sms = $_POST['phone'];
    $code_sms  = rand(100000, 999999);

    $username_sms = urlencode("aliFR10");
    $password_sms = urlencode("alifrALIFR10!)");
    $message_sms  = urlencode("کد فعال سازی شما : " . $code_sms);

    $url = "http://smspanel.Trez.ir/SendMessageWithCode.ashx?Username=$username_sms&Password=$password_sms&Mobile=$phone_sms&Message=$message_sms";

    $result_sms = file_get_contents($url);

    echo $result_sms;

    echo "<pre>";
    var_dump($result_sms);
    echo "</pre>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تست اعتبارسنجی</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="phone">
        <input type="submit" value="send">
    </form>
</body>

</html>