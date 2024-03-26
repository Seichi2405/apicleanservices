<?php
require "config.php";

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_ctv = $_POST['id_ctv'];

    // Truy vấn thông tin người dùng từ bảng users dựa trên id_ctv
    $query = mysqli_query($connection, "SELECT * FROM user WHERE id_user = '$id_ctv'");

    if ($query) {
        $user = mysqli_fetch_assoc($query);

        // Kiểm tra xem có thông tin người dùng hay không
        if ($user) {
            $response = array('value' => 1, 'message' => 'Lấy thông tin người dùng thành công', 'data' => $user);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            $response = array('value' => 2, 'message' => 'Không tìm thấy người dùng với id_ctv đã cho');
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $response = array('value' => 2, 'message' => 'Lỗi truy vấn cơ sở dữ liệu');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    $response = array('value' => 2, 'message' => 'Phương thức không hỗ trợ');
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
?>
