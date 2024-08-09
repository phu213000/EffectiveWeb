<?php
// static/views/InsertViewTask.php

function displaySimpleTaskTable($tasks) {
    echo '<table class="table table-striped">';
    echo '<thead><tr><th>#</th><th>Task Name</th></tr></thead>';
    echo '<tbody>';
    $index = 1;
    foreach ($tasks as $task) {
        echo '<tr>';
        echo '<td>' . $index++ . '</td>';
        echo '<td>' . htmlspecialchars($task['name']) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}

// static/views/InsertViewTask.php

function displayInsertTaskForm() {
    echo '<div class="card mt-4">';
    echo '<div class="card-header text-center">';
    echo '<h3>Add New Task</h3>';
    echo '</div>';
    echo '<div class="card-body">';
    echo '<form method="POST" action="../../static/controllers/InsertTaskController.php">';
    echo '<div class="form-group">';
    echo '<label for="task_name">Task Name</label>';
    echo '<input type="text" name="mytask" class="form-control" id="task_name" required>';
    echo '</div>';
    echo '<button type="submit" name="add_task" class="btn btn-primary">Add Task</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
}


?>
