<?php
include('backend/db.php');

if (isset($_GET['list_id']) && isset($_GET['board_id'])) {
    $list_id = $_GET['list_id'];
    $board_id = $_GET['board_id'];

    // Menghapus list berdasarkan list_id
    $stmt = getDB()->prepare("DELETE FROM lists WHERE id = :list_id");
    $stmt->bindParam(':list_id', $list_id);
    $stmt->execute();

    // Redirect ke halaman list.php setelah menghapus list
    header("Location: list.php?board_id=" . $board_id);
    exit();
}
?>
