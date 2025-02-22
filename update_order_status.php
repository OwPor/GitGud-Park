<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

if (!isset($_POST['order_stall_id']) || !isset($_POST['new_status'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
    exit;
}

$order_stall_id = $_POST['order_stall_id'];
$new_status     = $_POST['new_status'];

$allowed_status = ['Pending', 'Preparing', 'Ready', 'Completed'];
if (!in_array($new_status, $allowed_status)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid status']);
    exit;
}

try {
    $dsn = "mysql:host=localhost;dbname=gitgud;charset=utf8";
    $pdo = new PDO($dsn, 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    
    $pdo->beginTransaction();
    
    if ($new_status == 'Preparing') {
        $stmtCheck = $pdo->prepare("SELECT queue_number, created_at FROM order_stalls WHERE id = :order_stall_id");
        $stmtCheck->execute(['order_stall_id' => $order_stall_id]);
        $row = $stmtCheck->fetch();
        
        if (!$row['queue_number'] || (date("Y-m-d", strtotime($row['created_at'])) != date("Y-m-d"))) {
            $stmtMax = $pdo->prepare("SELECT MAX(queue_number) AS max_queue FROM order_stalls WHERE DATE(created_at) = CURDATE() AND queue_number IS NOT NULL");
            $stmtMax->execute();
            $resMax = $stmtMax->fetch();
            $nextQueue = $resMax['max_queue'] ? intval($resMax['max_queue']) + 1 : 1;
            
            $stmtUpdateQueue = $pdo->prepare("UPDATE order_stalls SET queue_number = :queue_number WHERE id = :order_stall_id");
            $stmtUpdateQueue->execute(['queue_number' => $nextQueue, 'order_stall_id' => $order_stall_id]);
        }
    }
    
    $stmt = $pdo->prepare("UPDATE order_stalls SET status = :new_status WHERE id = :order_stall_id");
    $stmt->execute(['new_status' => $new_status, 'order_stall_id' => $order_stall_id]);
    
    $pdo->commit();
    
    echo json_encode(['status' => 'success', 'message' => 'Order status updated']);
} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
