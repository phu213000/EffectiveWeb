<?php
// static/views/ViewTaskView.php

function displayTaskDetails($task) {
    echo '<div class="card mt-4">';
    echo '<div class="card-header text-center">';
    echo '<h3>Task Details</h3>';
    echo '</div>';
    echo '<div class="card-body">';
    echo '<table class="table">';
    echo '<tr><th>Task Name:</th><td>' . htmlspecialchars($task['name']) . '</td></tr>';
    echo '<tr><th>Created At:</th><td>' . htmlspecialchars($task['created_at']) . '</td></tr>';
    echo '</table>';
    echo '<a href="manage.php" class="btn btn-primary">Back to Task List</a>';
    echo '</div>';
    echo '</div>';
}

function displayTaskTable($tasks) {
    echo '<table class="table table-striped">';
    echo '<thead><tr><th>#</th><th>Task Name</th><th>Created At</th><th>Actions</th></tr></thead>';
    echo '<tbody>';
    $index = 1;
    foreach ($tasks as $task) {
        echo '<tr>';
        echo '<td>' . $index++ . '</td>';
        echo '<td>' . htmlspecialchars($task['name']) . '</td>';
        echo '<td>' . htmlspecialchars($task['created_at']) . '</td>';
        echo '<td>';
        echo '<a href="manage.php?action=view&id=' . htmlspecialchars($task['id']) . '" class="btn btn-info btn-sm">View</a> ';
        echo '<a href="manage.php?action=edit&id=' . htmlspecialchars($task['id']) . '" class="btn btn-warning btn-sm">Edit</a> ';
        echo '<a href="manage.php?action=delete&id=' . htmlspecialchars($task['id']) . '" class="btn btn-danger btn-sm">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}
?>
