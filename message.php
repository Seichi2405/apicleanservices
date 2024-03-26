<?php

require "config.php";

header("Access-Control-Allow-Origin: *");

class ChatController {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function createMessage() {
        $data = $_POST;
        $senderId = $data['sender_id'];
        $receiverId = $data['receiver_id'];
        $content = $data['content'];

        // Thêm tin nhắn vào CSDL
        $timestamp = date("Y-m-d H:i:s");
        $query = "INSERT INTO messages (sender_id, receiver_id, content, timestamp) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$senderId, $receiverId, $content, $timestamp]);

        echo json_encode(['message' => 'Tin nhắn đã được tạo thành công.']);
    }

    public function getMessages($senderId, $receiverId) {
        // Lấy tin nhắn từ CSDL
        $query = "SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$senderId, $receiverId, $receiverId, $senderId]);
        $messages = $stmt->fetchAll();

        echo json_encode(['messages' => $messages]);
    }

    public function getConversations($userId) {
        // Lấy danh sách cuộc trò chuyện từ CSDL
        $query = "SELECT DISTINCT receiver_id FROM messages WHERE sender_id = ? UNION SELECT DISTINCT sender_id FROM messages WHERE receiver_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$userId, $userId]);
        $conversations = $stmt->fetchAll();

        echo json_encode(['conversations' => $conversations]);
    }
}

// Kết nối đến CSDL (MySQL)
$dsn = 'mysql:host=localhost;dbname=testclean1';
$username = 'root';
$password = '123456';

$pdo = new PDO($dsn, $username, $password);

// Dependency Injection cho Controller
$chatController = new ChatController($pdo);

// Xử lý yêu cầu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'createMessage':
            $chatController->createMessage();
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getMessages':
            if (isset($_GET['sender_id']) && isset($_GET['receiver_id'])) {
                $chatController->getMessages($_GET['sender_id'], $_GET['receiver_id']);
            } else {
                echo json_encode(['error' => 'Missing parameters']);
            }
            break;
        case 'getConversations':
            if (isset($_GET['user_id'])) {
                $chatController->getConversations($_GET['user_id']);
            } else {
                echo json_encode(['error' => 'Missing parameters']);
            }
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
