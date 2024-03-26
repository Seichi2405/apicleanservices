<?php
require "config.php";

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id_appointment'])) {
        $idAppointment = $_POST['id_appointment'];

     
        $checkAppointmentQuery = "SELECT * FROM appointments WHERE id_appointment = '$idAppointment'";
        $checkAppointmentResult = $connection->query($checkAppointmentQuery);

        if ($checkAppointmentResult->num_rows > 0) {
        
            $updateStatusQuery = "UPDATE appointments SET status = 3 WHERE id_appointment = '$idAppointment'";
            if ($connection->query($updateStatusQuery) === TRUE) {
                $response = array('value' => 1, 'message' => 'Xác nhận hoàn thành thành công');
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            } else {
                $response = array('value' => 2, 'message' => 'Lỗi khi cập nhật trạng thái: ' . $connection->error);
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }
        } else {
            $response = array('value' => 2, 'message' => 'Lịch đặt không tồn tại');
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $response = array('value' => 2, 'message' => 'Thiếu thông tin id_appointment');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    $response = array('value' => 2, 'message' => 'Lỗi');
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
?>
