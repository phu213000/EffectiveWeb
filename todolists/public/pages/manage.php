<?php 
require '../../static/config/config.php';
require '../../static/models/TasksModel.php';
require '../../static/views/ViewTaskView.php';
require '../../static/views/InsertViewTask.php';

$tasks = [];
$task = null;
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

$successMessage = '';
$errorMessage = '';

// Kiểm tra nếu có thông báo thành công
if (isset($_GET['success'])) {
    $successMessage = $_GET['success'];
}

if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
}

// Xử lý các hành động như edit, delete, view
if ($action) {
    switch ($action) {
        case 'edit':
            $task = getTaskById($conn, $id);
            break;
        case 'delete':
            deleteTask($conn, $id);
            header("Location: manage.php?success=" . urlencode("Task has been deleted successfully!"));
            exit();
        case 'view':
            $task = getTaskById($conn, $id);
            break;
    }
} else {
    $tasks = getAllTasks($conn);
}

// Xử lý cập nhật task khi form chỉnh sửa được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_task'])) {
    $updatedTaskName = $_POST['task_name'];
    $taskId = $_POST['task_id'];
    updateTask($conn, $taskId, $updatedTaskName);
    header("Location: manage.php?success=" . urlencode("Task has been updated successfully!"));
    exit();
}

// Xử lý thêm task mới khi form thêm task được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_task'])) {
    $newTaskName = $_POST['task_name'];
    if (insertTask($conn, $newTaskName)) {
        header("Location: manage.php?success=" . urlencode("New task has been added successfully!"));
        exit();
    } else {
        $errorMessage = "Failed to add the new task. Please try again.";
    }
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

            <!-- Hiển thị thông báo thành công hoặc lỗi -->
            <?php if ($successMessage): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo htmlspecialchars($successMessage); ?>
                </div>
            <?php endif; ?>

            <?php if ($errorMessage): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($errorMessage); ?>
                </div>
            <?php endif; ?>

            <!-- Hiển thị form thêm task mới -->
            <?php 
            // Chỉ hiển thị form thêm task nếu không đang xem chi tiết hoặc chỉnh sửa task
            if (!$task && !$action) {
                displayInsertTaskForm(); 
            }
            ?>

            <!-- Xử lý và hiển thị chi tiết hoặc chỉnh sửa task -->
            <?php 
            if ($task && $action === 'view') {
                displayTaskDetails($task);
            } elseif ($task && $action === 'edit') {
                echo '<div class="card mt-4">';
                echo '<div class="card-header text-center">';
                echo '<h3>Edit Task</h3>';
                echo '</div>';
                echo '<div class="card-body">';
                echo '<form method="POST" action="">';
                echo '<input type="hidden" name="task_id" value="' . htmlspecialchars($task['id']) . '">';
                echo '<div class="form-group">';
                echo '<label for="task_name">Task Name</label>';
                echo '<input type="text" name="task_name" class="form-control" id="task_name" value="' . htmlspecialchars($task['name']) . '" required>';
                echo '</div>';
                echo '<button type="submit" name="update_task" class="btn btn-primary">Update Task</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
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
    <script src="https://stackpath.amazonaws.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
