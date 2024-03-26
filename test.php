<?php
require "config.php";

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_user = $_POST['id_user']; 

    $stmt = $connection->prepare("
        SELECT
            DATE_FORMAT(appointments.datetime, '%m-%Y') as month_year,
            SUM(appointments.price) as total_revenue
        FROM
            appointments
        WHERE
            appointments.id_ctv = ? AND 
            appointments.status = 3
        GROUP BY
            month_year
    ");

    if ($stmt === false) {
        die('Lỗi truy vấn cơ sở dữ liệu');
    }

    $stmt->bind_param("s", $id_user); 

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result) {
        $revenue_data = $result->fetch_all(MYSQLI_ASSOC);

       
        if (!empty($revenue_data)) {
            $response = array('value' => 1, 'message' => 'Lấy thông tin doanh thu thành công', 'data' => $revenue_data);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            $response = array('value' => 2, 'message' => 'Không có dữ liệu doanh thu cho id_user với status = 3');
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $response = array('value' => 2, 'message' => 'Lỗi truy vấn cơ sở dữ liệu');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

 
    $stmt->close();
} else {
    $response = array('value' => 2, 'message' => 'Phương thức không hỗ trợ');
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}


$connection->close();
?>
