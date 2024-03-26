<?php

require "config.php";
    
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = array();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = md5($_POST['password']);

    $queryCheckUser = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email' OR phone = '$phone'");
    $checkUserResult = mysqli_fetch_array($queryCheckUser);

    if ($checkUserResult) {
        $response['value'] = 0;
        $response['message'] = "Rất tiếc, dữ liệu đã được đăng ký!";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    } else {
        // Thêm người dùng mới với giá trị id_role là 3
        $queryInsertUser = "INSERT INTO user (name, email, phone, address, password, created_at, status, id_role) VALUES ('$name','$email', '$phone', '$address', '$password', NOW(), 1, 2)";
        $queryInsertUserResult = mysqli_query($connection, $queryInsertUser);

        if ($queryInsertUserResult) {
            $response['value'] = 1;
            $response['message'] = "Vâng, Đăng ký thành công. Vui lòng đăng nhập bằng tài khoản của bạn";
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            $response['value'] = 2;
            $response['message'] = "Rất tiếc, đăng ký không thành công";
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    }
}

    // require "config.php";
    
    // header("Access-Control-Allow-Origin: *");

    // if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //     # code...
    //     $response = array();
    //     $name = $_POST['name'];
    //     $email = $_POST['email'];
    //     $phone = $_POST['phone'];
    //     $address = $_POST['address'];
    //     $password = md5($_POST['password']);

    //     $query_cek_user = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email' || phone = '$phone'");

    //     $cek_user_result = mysqli_fetch_array($query_cek_user);

    //     if ($cek_user_result) {
    //         # code...
    //         $response['value'] = 0;
    //         $response['message'] = "Rất tiếc, dữ liệu đã được đăng ký!";
    //         echo json_encode($response, JSON_UNESCAPED_UNICODE);
    //     }
    //     else {
    //         // $query = "INSERT INTO user(email,password,phone,address) VALUES ('$email', '$password', '$phone', '$address')";
           
           
    //         // $query_insert_user = mysqli_query($connection, $query);
    //         $query_insert_user = mysqli_query($connection, "INSERT INTO user (name, email, phone, address, password, created_at, status) VALUES ('$name','$email', '$phone', '$address', '$password', NOW(), 1)");

    //       // return var_dump($query);  
    //        if ($query_insert_user) {
    //             # code...
    //             $response['value'] = 1;
    //             $response['message'] = "Vâng, Đăng ký thành công. Vui lòng đăng nhập bằng tài khoản của bạn";
    //             echo json_encode($response, JSON_UNESCAPED_UNICODE);
    //         }else {
    //             #code...
    //             $response['value'] = 2;
    //             $response['message'] = "Rất tiếc, đăng ký không thành công";
    //             echo json_encode($response, JSON_UNESCAPED_UNICODE);
    //         }
    //     }
    // }
?>