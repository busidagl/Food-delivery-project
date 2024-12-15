<?php
header('Content-Type: application/json');
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

                if (empty($username) || empty($email) || empty($password)) {
                        echo json_encode(['status' => 'error', 'message' => 'Please fill all fields.']);
                                exit;
                                    }

                                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                                 echo json_encode(['status' => 'error', 'message' => 'Invalid email format']);
                                                         exit;
                                                             }
                                                                   //Check if username already exist
                                                                           $checkStmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
                                                                                   $checkStmt->bind_param("s", $username);
                                                                                           $checkStmt->execute();
                                                                                                   $checkResult = $checkStmt->get_result();
                                                                                                          if($checkResult->num_rows > 0){
                                                                                                                   echo json_encode(['status' => 'error', 'message' => 'Username already taken.']);
                                                                                                                              $checkStmt->close();
                                                                                                                                         exit;
                                                                                                                                                }

                                                                                                                                                     // Check if email already exist
                                                                                                                                                          $checkStmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
                                                                                                                                                               $checkStmt->bind_param("s", $email);
                                                                                                                                                                    $checkStmt->execute();
                                                                                                                                                                         $checkResult = $checkStmt->get_result();

                                                                                                                                                                             if ($checkResult->num_rows > 0) {
                                                                                                                                                                                       echo json_encode(['status' => 'error', 'message' => 'Email already registered.']);
                                                                                                                                                                                                  $checkStmt->close();
                                                                                                                                                                                                            exit;
                                                                                                                                                                                                                 }
                                                                                                                                                                                                                       $checkStmt->close();

                                                                                                                                                                                                                           $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                                                                                                                                                                                                                               $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                                                                                                                                                                                                                                   $stmt->bind_param("sss", $username, $email, $hashedPassword);

                                                                                                                                                                                                                                       if ($stmt->execute()) {
                                                                                                                                                                                                                                                echo json_encode(['status' => 'success', 'message' => 'Registration successful']);
                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                             echo json_encode(['status' => 'error', 'message' => 'Error during registration: ' . $stmt->error]);
                                                                                                                                                                                                                                                                 }
                                                                                                                                                                                                                                                                     $stmt->close();
                                                                                                                                                                                                                                                                     } else {
                                                                                                                                                                                                                                                                         echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
                                                                                                                                                                                                                                                                         }
                                                                                                                                                                                                                                                                         $conn->close();
                                                                                                                                                                                                                                                                         ?>