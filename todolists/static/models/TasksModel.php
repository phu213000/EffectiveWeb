<?php
// static/models/TasksModel.php

function getAllTasks($conn) {
    $stmt = $conn->prepare("SELECT * FROM tasks ORDER BY created_at DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTaskById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateTask($conn, $id, $name) {
    $stmt = $conn->prepare("UPDATE tasks SET name = :name WHERE id = :id");
    $stmt->execute([':name' => $name, ':id' => $id]);
}

function deleteTask($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->execute([':id' => $id]);
}
function insertTask($conn, $task) {
    $stmt = $conn->prepare("INSERT INTO tasks (name) VALUES (:name)");
    return $stmt->execute([':name' => $task]);
}
function searchTasks($conn, $searchTerm) {
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE name LIKE :name");
    $stmt->execute([':name' => "%$searchTerm%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
