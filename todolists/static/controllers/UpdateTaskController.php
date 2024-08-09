<?php
// static/controllers/UpdateTaskController.php
require '../config/config.php';
require '../models/TasksModel.php';

function handleUpdateTask($conn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $task = $_POST['mytask'];
        updateTask($conn, $id, $task);
        header("Location: ../../pages/manage.php");
        exit();
    }
}

function getTaskToUpdate($conn, $id) {
    return getTaskById($conn, $id);
}
?>
