

<?php

// require "config.php";

// header("Access-Control-Allow-Origin: *");

// $response = array();


// $idAppointment = isset($_GET['id_appointment']) ? $_GET['id_appointment'] : null;

// if ($idAppointment === null) {
//     echo json_encode(['error' => 'ID appointment is missing']);
//     exit;
// }

// $cek_transaction = mysqli_query($connection, "SELECT * FROM transaction_status WHERE id_appointment = '$idAppointment'");

// while ($row_transaction = mysqli_fetch_array($cek_transaction)) {
//     $key = array(
//         'id_transaction' => $row_transaction['id_transaction'],
//         'id_appointment' => $row_transaction['id_appointment'],
//         'payment_method' => $row_transaction['payment_method'],
//         'status_pay' => $row_transaction['status_pay']
//     );

//     array_push($response, $key);
// }

// echo json_encode($response);


require "config.php";

header("Access-Control-Allow-Origin: *");

$response = array();

$cek_transaction = mysqli_query($connection, "SELECT * FROM transaction_status");

while ($row_transaction = mysqli_fetch_array($cek_transaction)) {
    $key = array(
        'id_transaction' => $row_transaction['id_transaction'],
        'id_appointment' => $row_transaction['id_appointment'],
        'payment_method' => $row_transaction['payment_method'],
        'status_pay' => $row_transaction['status_pay']
    );

    array_push($response, $key);
}

echo json_encode($response);

?>


