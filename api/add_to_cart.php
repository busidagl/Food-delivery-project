<?php
session_start();
header('Content-Type: application/json');
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
           echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
                   exit;
                       }

                           $user_id = $_SESSION['user_id'];
                               $menu_item_id = $_POST['menu_item_id'] ?? null;
                                   $quantity = $_POST['quantity'] ?? 1;

                                       if ($menu_item_id === null) {
                                              echo json_encode(['status' => 'error', 'message' => 'Missing menu_item_id']);
                                                      exit;
                                                          }

                                                              $stmt = $conn->prepare("INSERT INTO cart (user_id, menu_item_id, quantity) VALUES (?, ?, ?)");
                                                                  $stmt->bind_param("iii", $user_id, $menu_item_id, $quantity);

                                                                      if ($stmt->execute()) {
                                                                              echo json_encode(['status' => 'success', 'message' => 'Item added to cart']);
                                                                                  } else {
                                                                                          echo json_encode(['status' => 'error', 'message' => 'Error adding item to cart: ' . $stmt->error]);
                                                                                              }
                                                                                                  $stmt->close();
                                                                                                  }
                                                                                                  else {
                                                                                                      echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
                                                                                                      }
                                                                                                      $conn->close();
                                                                                                      ?>