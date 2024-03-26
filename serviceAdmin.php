<?php

require "config.php";

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $response = array();

    // Kiểm tra xem các trường dữ liệu cần thiết có tồn tại không
    if (
        !empty($_POST['name']) &&
        !empty($_POST['description']) &&
        !empty($_POST['price']) &&
        !empty($_POST['imagePath'])
    ) {
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $description = mysqli_real_escape_string($connection, $_POST['description']);
        $price = mysqli_real_escape_string($connection, $_POST['price']);
        $imagePath = mysqli_real_escape_string($connection, $_POST['imagePath']);

        // Câu truy vấn để thêm thông tin dịch vụ vào bảng service với giá trị mặc định cho trường 'status'
        $insertServiceQuery = "INSERT INTO service (name, description, image, price, status, created_at) VALUES ('$name', '$description', '$imagePath', '$price', 1, NOW())";

        $insertServiceResult = mysqli_query($connection, $insertServiceQuery);

        if ($insertServiceResult) {
            $response['value'] = 1;
            $response['message'] = "Thêm thông tin dịch vụ thành công";
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            $response['value'] = 2;
            $response['message'] = "Lỗi khi thêm thông tin dịch vụ: " . mysqli_error($connection);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $response['value'] = 3;
        $response['message'] = "Thiếu thông tin cần thiết để thêm dịch vụ";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    $response['value'] = 4;
    $response['message'] = "Phương thức yêu cầu không hợp lệ";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

?>
