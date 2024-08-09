<?php
// static/controllers/ViewTaskController.php
require '../config/config.php';
require '../models/TasksModel.php';

function handleViewTask($conn, $id) {
    return getTaskById($conn, $id);
}
?>
