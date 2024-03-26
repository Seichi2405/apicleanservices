<?php
// require "config.php";

// header("Access-Control-Allow-Origin: *");

// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//     if (isset($_POST['id_service'])) {
//         $id_service = $_POST['id_service'];

//         $sql = "SELECT * FROM appointments WHERE id_service = '$id_service'";

//         $result = $connection->query($sql);

//         if ($result->num_rows > 0) {
//             $appointments = array();
//             while ($row = $result->fetch_assoc()) {
//                 $appointments[] = $row;
//             }
//             echo json_encode($appointments, JSON_UNESCAPED_UNICODE);
//         } else {
//             $response = array('value' => 2, 'message' => 'Không tìm thấy appointment nào cho idservice này');
//             echo json_encode($response, JSON_UNESCAPED_UNICODE);
//         }
//     } else {
//         $response = array('value' => 2, 'message' => 'Dữ liệu không hợp lệ');
//         echo json_encode($response, JSON_UNESCAPED_UNICODE);
//     }
// } else {
//     $response = array('value' => 2, 'message' => 'Lỗi');
//     echo json_encode($response, JSON_UNESCAPED_UNICODE);
// }

require "config.php";

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id_service'])) {
        $id_service = $_POST['id_service'];

        $sql = "SELECT appointments.*, service.name AS service_name, user.name AS user_name, user.phone AS user_phone, user.address AS user_address
        FROM appointments
        INNER JOIN service ON appointments.id_service = service.id_service
        INNER JOIN user ON appointments.id_user = user.id_user
        WHERE appointments.id_service = '$id_service'";

        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $appointments = array();
            while ($row = $result->fetch_assoc()) {
                $appointments[] = $row;
            }
            echo json_encode($appointments, JSON_UNESCAPED_UNICODE);
        } else {
            $response = array('value' => 2, 'message' => 'Không tìm thấy appointment nào cho idservice này');
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
