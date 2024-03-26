<?php
// require "config.php";

// header("Access-Control-Allow-Origin: *");

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
//     $searchTerm = $_POST['search'];

//     // Kiểm tra kết nối
//     if ($conn) {
//         // Sử dụng prepared statement để tránh SQL injection
//         $stmt = $conn->prepare("
//             SELECT * FROM service WHERE name LIKE ?
           
//         ");

//         if ($stmt) {
//             $searchTermService = '%' . $searchTerm . '%';
//             $searchTermAppointments = '%' . $searchTerm . '%';

//             // Binds parameters
//             $stmt->bind_param("sss", $searchTermService, $searchTermAppointments, $searchTermAppointments, $searchTermAppointments);

//             // Execute the statement
//             $stmt->execute();

//             // Get the result
//             $result = $stmt->get_result();

//             // Convert the result to a JSON array
//             $searchResults = [];
//             while ($row = $result->fetch_assoc()) {
//                 $searchResults[] = $row;
//             }

//             // Return the JSON result
//             header('Content-Type: application/json');
//             echo json_encode($searchResults);

//             // Close the statement
//             $stmt->close();
//         } else {
//             echo "Error in preparing statement";
//         }
//     } else {
//         echo "Error in database connection";
//     }

//     // Close the database connection
//     $conn->close();
// } else {
//     echo "Invalid request";
// }
?>
