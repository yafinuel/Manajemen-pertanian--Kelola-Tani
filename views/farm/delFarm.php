<?php
    require_once "../../includes/conn.php";
    requireLogin();
    
    $id_user = $_SESSION['id_user'];

    if(!isset($_GET['id'])){
        header("Location: farm.php");
        exit();
    }
    
    $id_farm = $_GET['id'];
    $query = 'DELETE FROM farms WHERE id_farm =? and id_user = ?';
    $stmt = $conn->prepare($query);
    if ($stmt){
        $stmt->bind_param('ii', $id_farm, $id_user);
        $stmt->execute();
        header("Location: farm.php");
    }
?>