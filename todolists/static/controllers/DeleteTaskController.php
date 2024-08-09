<?php
// static/controllers/DeleteTaskController.php
require '../config/config.php';
require '../models/TasksModel.php';

function handleDeleteTask($conn, $id) {
    deleteTask($conn, $id);
    header("Location: ../../pages/manage.php");
    exit();
}
?>
