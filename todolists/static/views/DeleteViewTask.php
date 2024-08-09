<?php
// static/views/DeleteTaskView.php

function displayDeleteConfirmation($task) {
    echo '
    <p>Are you sure you want to delete the task: ' . $task['name'] . '?</p>
    <form method="POST" action="../static/controllers/DeleteTaskController.php?id=' . $task['id'] . '">
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="../../pages/manage.php" class="btn btn-secondary">Cancel</a>
    </form>';
}
?>
