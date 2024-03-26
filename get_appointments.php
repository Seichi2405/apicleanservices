<?php
// require "config.php";

// header("Access-Control-Allow-Origin: *");

// $response = array();

// $cek_appointments = mysqli_query($connection, "SELECT * FROM appointments");

// while ($row_appointment = mysqli_fetch_array($cek_appointments)) {
//     $key['id_appointment'] = $row_appointment['id_appointment'];
//     $key['id_user'] = $row_appointment['id_user'];
//     $key['id_service'] = $row_appointment['id_service'];
//     $key['repeatTime'] = $row_appointment['repeatTime'];
//     $key['price'] = $row_appointment['price'];
//     $key['description'] = $row_appointment['description'];
//     $key['roomSize'] = $row_appointment['roomSize'];
//     $key['dirtLevel'] = $row_appointment['dirtLevel'];
//     $key['datetime'] = $row_appointment['datetime'];
//     $key['status'] = $row_appointment['status'];

//     array_push($response, $key);
// }
// echo json_encode($response);
require "config.php";

header("Access-Control-Allow-Origin: *");

$response = array();

$cek_appointments = mysqli_query($connection, "SELECT * FROM appointments");

while ($row_appointment = mysqli_fetch_array($cek_appointments)) {
    $id_user = $row_appointment['id_user'];
    $id_service = $row_appointment['id_service'];

    $user_query = mysqli_query($connection, "SELECT name, phone, address FROM user WHERE id_user = $id_user");
    $user_data = mysqli_fetch_array($user_query);

    $service_query = mysqli_query($connection, "SELECT name FROM service WHERE id_service = $id_service");
    $service_data = mysqli_fetch_array($service_query);

    $key = array(
        'id_appointment' => $row_appointment['id_appointment'],
        'id_user' => $row_appointment['id_user'],
        'id_service' => $row_appointment['id_service'],
        'repeatTime' => $row_appointment['repeatTime'],
        'price' => $row_appointment['price'],
        'description' => $row_appointment['description'],
        'roomSize' => $row_appointment['roomSize'],
        'dirtLevel' => $row_appointment['dirtLevel'],
        'datetime' => $row_appointment['datetime'],
        'status' => $row_appointment['status'],
        'user_name' => $user_data['name'],
        'user_phone' => $user_data['phone'],
        'user_address' => $user_data['address'],
        'service_name' => $service_data['name'],
        'id_ctv' => $row_appointment['id_ctv'],
    );

    array_push($response, $key);
}

echo json_encode($response);



?>
