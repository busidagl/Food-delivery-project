<?php
session_start();
header('Content-Type: application/json');
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        exit;
        }

        $user_id = $_SESSION['user_id'];

        $stmt = $conn->prepare("SELECT c.cart_id, m.name, m.price, m.image, c.quantity FROM cart c INNER JOIN menu m ON c.menu_item_id = m.menu_item_id WHERE c.user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $cart_items = [];
        while ($row = $result->fetch_assoc()) {
            $cart_items[] = $row;
            }

            echo json_encode(['status' => 'success', 'cart' => $cart_items]);

            $stmt->close();
            $conn->close();
            ?>