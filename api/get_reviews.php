<?php
header('Content-Type: application/json');
include 'config.php';

$menu_item_id = $_GET['menu_item_id'] ?? null;

if ($menu_item_id === null) {
    echo json_encode(['status' => 'error', 'message' => 'Missing menu_item_id']);
        exit;
        }

        $stmt = $conn->prepare("SELECT r.rating, r.comment, u.username, r.review_date FROM reviews r JOIN users u ON r.user_id = u.user_id WHERE r.menu_item_id = ?");
        $stmt->bind_param("i", $menu_item_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $reviews = [];
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
            }

            echo json_encode(['status' => 'success', 'reviews' => $reviews]);

            $stmt->close();
            $conn->close();
            ?>