<?php
header('Content-Type: application/json');
include 'config.php';

$sql = "SELECT * FROM menu";
$result = $conn->query($sql);

$menu_items = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
            $menu_items[] = $row;
                }
                     echo json_encode(['status' => 'success', 'menu' => $menu_items]);
                     } else {
                       echo json_encode(['status' => 'error', 'message' => 'Menu items not found']);
                       }

                       $conn->close();
                       ?>