<?php
require "config.php";

header("Access-Control-Allow-Origin: *");


if (
    isset($_POST['id_appointment'], $_POST['price'], $_POST['payment_method'], $_POST['status_pay'])
) {
    
    $id_appointment = $_POST['id_appointment'];
    $price = $_POST['price'];
    $payment_method = $_POST['payment_method'];
    $status_pay = $_POST['status_pay'];

    
    $sql = "INSERT INTO transaction_status (id_appointment, price, payment_method, status_pay) VALUES ('$id_appointment', '$price', '$payment_method', '$status_pay')";

    if ($connection->query($sql) === TRUE) {
       
        $response = array('value' => 1, 'message' => 'Trạng thái thanh toán được lưu thành công');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    } else {
        $response = array('value' => 2, 'message' => 'Lỗi khi lưu trạng thái thanh toán: ' . $connection->error);
        error_log('MySQL Error: ' . $connection->error, 0);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    $response = array('value' => 2, 'message' => 'Dữ liệu không hợp lệ');
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}


$connection->close();
?>
