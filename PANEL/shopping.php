<?php

// Send Parameter

$amount = $_POST['total'];

if (isset($_POST['shopping'])) {
    $data = [
        'pin'    => 'sandbox',
        'amount'    => $amount,
        'callback' => 'http://localhost/113-CODEYADPROJECT/PANEL/verify.php',
    ];

    // echo $amount;
    // exit;

    $data = json_encode($data);
    $ch = curl_init('https://panel.aqayepardakht.ir/api/v2/create');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        )
    );
    $result = curl_exec($ch);
    curl_close($ch);
    // if ($result === false) {
    //     die(curl_error($ch));
    // }

    // echo "<pre>";
    // var_dump($result);
    // echo "</pre>";
    // exit;
    $result = json_decode($result);
    if ($result->status == "success") {
        // echo $result->transid;
        // exit;

        // echo "<pre>";
        // print_r($result);
        // exit;


        // $url = 'https://panel.aqayepardakht.ir/startpay/' . $result->transid;

        // echo $url;
        // exit;

        
        header('Location: https://panel.aqayepardakht.ir/startpay/' . $result->transid);
        exit;
    } else {
        echo "خطا";
    }


    // verify Transaction

    // $data = [
    //     'pin'    => 'sandbox',
    //     'amount'    => 20000,
    //     'transid' => $_GET['transid']
    // ];

    // $data = json_encode($data);
    // $ch = curl_init('https://panel.aqayepardakht.ir/api/v2/verify');
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // curl_setopt(
    //     $ch,
    //     CURLOPT_HTTPHEADER,
    //     array(
    //         'Content-Type: application/json',
    //         'Content-Length: ' . strlen($data)
    //     )
    // );
    // $result = curl_exec($ch);
    // curl_close($ch);
    // $result = json_decode($result);
    // if ($result->code == "1") {
    //     // تراکنش موفق
    // } else {
    //     // تراکنش ناموفق
    // }
}
