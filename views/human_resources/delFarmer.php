<?php
    require_once "../../includes/conn.php";
    requireLogin();
    
    $id_user = $_SESSION['id_user'];

    if(!isset($_GET['id'])){
        header("Location: hr.php");
        exit();
    }
    
    $id_farmer = $_GET['id'];
    $query = 'DELETE FROM farmers WHERE id_farmer=? and id_user = ?';
    $stmt = $conn->prepare($query);
    if ($stmt){
        $stmt->bind_param('ii', $id_farmer, $id_user);
        $stmt->execute();
        header("Location: hr.php");
    }
?>