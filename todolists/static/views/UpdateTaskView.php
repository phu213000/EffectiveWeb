<?php
// static/views/UpdateTaskView.php

function displayUpdateTaskForm($task) {
    echo '
    <form method="POST" action="../static/controllers/UpdateTaskController.php">
        <input type="hidden" name="id" value="' . $task['id'] . '">
        <div class="input-container d-flex mb-4">
            <input name="mytask" type="text" class="form-control mr-2" value="' . $task['name'] . '">
            <button name="submit" type="submit" class="btn btn-warning">Update Task</button>
        </div>
    </form>';
}
?>
