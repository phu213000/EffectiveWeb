<?php 
require '../../static/config/config.php';
require '../../static/models/TasksModel.php';
require '../../static/views/ViewTaskView.php';

// Kiểm tra hành động của người dùng và thực hiện theo hành động đó
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    
    switch ($action) {
        case 'edit':
            // Thực hiện chức năng chỉnh sửa
            $task = getTaskById($conn, $id);
            // Hiển thị form chỉnh sửa (cần tạo form để chỉnh sửa task trong ViewTaskView.php)
            break;
        case 'delete':
            // Thực hiện chức năng xóa
            deleteTask($conn, $id);
            header("Location: manage.php");
            exit();
        case 'view':
            // Hiển thị chi tiết task
            $task = getTaskById($conn, $id);
            displayTaskDetails($task);
            break;
    }
} else {
    // Hiển thị bảng task nếu không có hành động cụ thể
    $tasks = getAllTasks($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tasks</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="../../public/css/style.css"> 
</head>
<body>
    <div class="container mt-5">
        <div class="todo-container p-4 bg-white rounded shadow-sm">
            <h1 class="text-center mb-4">Manage Tasks</h1>
            <?php 
            // Hiển thị chi tiết task hoặc bảng task dựa trên hành động
            if (isset($task) && $action === 'view') {
                displayTaskDetails($task);
            } else {
                displayTaskTable($tasks);
            }
            ?>
            <a href="../../index.php" class="btn btn-secondary btn-back mt-4">Back to To-Do List</a> <!-- Đường dẫn trở về trang index -->
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (Optional, for certain components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
