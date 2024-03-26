<?php

    require "config.php";
    
    header("Access-Control-Allow-Origin: *");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        # code...
        $response = array();
        $email = $_POST['email'];
        $password = md5($_POST['password']);
      
        $query_login = mysqli_query($connection,"SELECT * FROM user WHERE email = '$email' AND password = '$password'"); 
        
        $cek_user_result = mysqli_fetch_array($query_login);

        if ($cek_user_result) {
            $response['value'] = 1;
            $response['message'] = "Vâng, Đăng nhập thành công";
            $response['id_user'] = (int)$cek_user_result['id_user'];
            $response['name'] = $cek_user_result['name'];
            $response['email'] = $cek_user_result['email'];
            $response['phone'] = $cek_user_result['phone'];
            $response['address'] = $cek_user_result['address'];
            $response['created_at'] = $cek_user_result['created_at'];
            $id_role = $cek_user_result['id_role'];
    
            $response['id_role'] = $id_role;
            $response['message'] = "Vâng, Đăng nhập thành công";
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }else {
            #code...
            $response['value'] = 2;
            $response['message'] = "Rất tiếc, đăng nhập không thành công";
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    }
?>        
       