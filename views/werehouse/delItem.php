<?php
    require_once "../../includes/conn.php";
    requireLogin();
    
    $id_user = $_SESSION['id_user'];

    if(!isset($_GET['id'])){
        header("Location: werehouse.php");
        exit();
    }
    
    $id_storage = $_GET['id'];
    $query = 'DELETE FROM storages WHERE id_storage =? and id_user = ?';
    $stmt = $conn->prepare($query);
    if ($stmt){
        $stmt->bind_param('ii', $id_storage, $id_user);
        $stmt->execute();
        header("Location: werehouse.php");
    }
?>