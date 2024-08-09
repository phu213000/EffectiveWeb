<?php 
require 'static/config/config.php';
require 'static/models/TasksModel.php';

// Biến chứa kết quả tìm kiếm
$tasks = [];

// Nếu người dùng thực hiện tìm kiếm
if (isset($_POST['search'])) {
    $searchTerm = $_POST['mytask'];
    $tasks = searchTasks($conn, $searchTerm);
} else {
    // Lấy tất cả các tasks nếu không tìm kiếm
    $tasks = getAllTasks($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="container">
        <div class="todo-container">
            <h1>My To-Do List</h1>
            <form method="POST" action="">
                <div class="input-container">
                    <input name="mytask" type="text" class="form-control" placeholder="Search for a task...">
                    <button name="search" type="submit" class="btn btn-info">Search</button>
                    <a href="public/pages/manage.php" class="btn btn-success">Manage Tasks</a>
                </div>
            </form>
            
            <!-- Hiển thị bảng đơn giản chỉ có số thứ tự và tên task -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?php echo $index++; ?></td>
                            <td><?php echo htmlspecialchars($task['name']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
