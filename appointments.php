<?php
require "config.php";

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (
        isset($_POST['id_user'], $_POST['id_service'], $_POST['datetime'], $_POST['repeatTime'], $_POST['price'],
        $_POST['description'], $_POST['roomSize'], $_POST['dirtLevel'],$_POST['address_2'])
    ) {
        $id_user = $_POST['id_user'];
        $id_service = $_POST['id_service'];
        $datetime = date('Y-m-d H:i:s', strtotime($_POST['datetime']));
        $repeatTime = $_POST['repeatTime'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $roomSize = $_POST['roomSize'];
        $dirtLevel = $_POST['dirtLevel'];
        $address_2 = $_POST['address_2'];
        $status = 1;
        $id_ctv = 0;
        
        $sql = "INSERT INTO appointments (id_user, id_service, datetime, repeatTime, price, description, roomSize, dirtLevel, address_2, status, id_ctv)
                VALUES ('$id_user', '$id_service', '$datetime', '$repeatTime', '$price', '$description', '$roomSize', '$dirtLevel','$address_2','$status', '$id_ctv')";

        if ($connection->query($sql) === TRUE) {
            $lastInsertedId = $connection->insert_id;
            $response = array('value' => 1, 'message' => 'Lịch đã được đặt thành công', 'id_appointment' => $lastInsertedId);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            $response = array('value' => 2, 'message' => 'Lỗi khi đặt lịch: ' . $connection->error);
            error_log('MySQL Error: ' . $connection->error, 0);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $response = array('value' => 2, 'message' => 'Dữ liệu không hợp lệ');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    $response = array('value' => 2, 'message' => 'Lỗi');
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

?>
