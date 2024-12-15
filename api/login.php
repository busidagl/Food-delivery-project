<?php
session_start();
header('Content-Type: application/json');
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';


            if (empty($username) || empty($password)) {
                     echo json_encode(['status' => 'error', 'message' => 'Please provide username and password']);
                             exit;
                                 }
                                      $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username = ?");
                                           $stmt->bind_param("s", $username);
                                                $stmt->execute();
                                                     $result = $stmt->get_result();

                                                          if($result->num_rows === 1) {
                                                                   $user = $result->fetch_assoc();
                                                                            if (password_verify($password, $user['password'])) {
                                                                                        $_SESSION['user_id'] = $user['user_id'];
                                                                                                    echo json_encode(['status' => 'success', 'message' => 'Login successful']);
                                                                                                            }else {
                                                                                                                        echo json_encode(['status' => 'error', 'message' => 'Incorrect password']);
                                                                                                                                }
                                                                                                                                     } else {
                                                                                                                                              echo json_encode(['status' => 'error', 'message' => 'User not found']);
                                                                                                                                                   }
                                                                                                                                                        $stmt->close();
                                                                                                                                                        } else {
                                                                                                                                                            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
                                                                                                                                                            }
                                                                                                                                                            $conn->close();
                                                                                                                                                            ?>