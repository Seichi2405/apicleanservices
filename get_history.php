<?php
require "config.php";

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['id_user'])) {
        $id_user = $_GET['id_user'];

        $query = mysqli_query($connection, "SELECT * FROM appointments WHERE id_user = '$id_user'");

        $history = array();
        while ($row = mysqli_fetch_assoc($query)) {
            $history[] = $row;
        }

        echo json_encode($history, JSON_UNESCAPED_UNICODE);
    } else {
        $response = array('value' => 2, 'message' => 'Thiếu tham số id_user');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    $response = array('value' => 2, 'message' => 'Lỗi');
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
?>
