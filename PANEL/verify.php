<?php
include "../database/pdo_connection.php";


$ID_user = $_GET['id'];
//  verify Transaction

$data = [
    'pin'    => 'sandbox',
    'amount'    => $_GET['amount'],
    'transid' => $_GET['transid']
];

$data = json_encode($data);
$ch = curl_init('https://panel.aqayepardakht.ir/api/v2/verify');
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
$result = json_decode($result);
if ($result->code == "1") {
    $result = $conn->prepare("UPDATE shopcard SET `status`=? WHERE id_user=?");
    $result->bindValue(1, 1);
    $result->bindValue(2, $ID_user);
    $result->execute();
    header("location:shopping.php");
    exit;
} else {
    header("location:unsuccessful.php");
    exit;
}
