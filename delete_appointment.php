<?php
require "config.php";

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id_appointment'])) {
        $id_appointment = $_POST['id_appointment'];

        $sql = "DELETE FROM appointments WHERE id_appointment = '$id_appointment'";
        $sql_transaction = "DELETE FROM transaction_status WHERE id_appointment = '$id_appointment'";
        if ($connection->query($sql) === TRUE) {
            if ($connection->query($sql_transaction) === TRUE) {
                $response = array('value' => 1, 'message' => 'Data deleted successfully');
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }
            $response = array('value' => 1, 'message' => 'Appointment deleted successfully');
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            $response = array('value' => 2, 'message' => 'Error deleting appointment: ' . $connection->error);
            error_log('MySQL Error: ' . $connection->error, 0);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $response = array('value' => 2, 'message' => 'Invalid input');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    $response = array('value' => 2, 'message' => 'Error');
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

?>
