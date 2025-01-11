<?php
include('backend/db.php');

if (isset($_GET['id'])) {
    $board_id = $_GET['id'];

    // Menghapus board berdasarkan id
    $stmt = getDB()->prepare("DELETE FROM boards WHERE id = :id");
    $stmt->bindParam(':id', $board_id);
    $stmt->execute();

    // Redirect ke halaman board.php setelah menghapus board
    header("Location: board.php");
    exit();
}
?>
