<?php

    require "config.php";

    header("Access-Control-Allow-Origin: *");

    $response = array();

    $cek_service = mysqli_query($connection, "SELECT * FROM service WHERE status = '1'");

    while ($row_service = mysqli_fetch_array($cek_service)) {
        # code...
        $key['id_service'] = $row_service['id_service'];
        
        $key['name'] = $row_service['name'];
        $key['description'] = $row_service['description'];
        $key['image'] = $row_service['image'];
        $key['price'] = $row_service['price'];
        $key['status'] = $row_service['status'];
        $key['created_at'] = $row_service['created_at'];
        

        array_push($response, $key);
    }
echo json_encode($response);
?>