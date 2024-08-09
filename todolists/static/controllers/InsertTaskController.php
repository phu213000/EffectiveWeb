<?php
// static/controllers/InsertTaskController.php

require '../config/config.php';
require '../models/TasksModel.php';

function handleInsertTask($conn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $task = $_POST['mytask']; // Lấy tên task từ form
        if (insertTask($conn, $task)) { // Thêm task vào database
            $successMessage = 'New task has been added successfully!';
            header("Location: ../../public/pages/manage.php?success=" . urlencode($successMessage));
            exit(); // Dừng xử lý script
        } else {
            $errorMessage = 'Failed to add the new task. Please try again.';
            header("Location: ../../public/pages/manage.php?error=" . urlencode($errorMessage));
            exit(); // Dừng xử lý script
        }
    }
}

// Gọi hàm handleInsertTask khi script được truy cập trực tiếp
handleInsertTask($conn);
?>
