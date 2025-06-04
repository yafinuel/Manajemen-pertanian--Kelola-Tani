<?php
    require_once "../../includes/conn.php";
    
    if(!isset($_GET['id'])){
        header("Location: hr.php");
        exit();
    }
    
    $id_farmer = $_GET['id'];
    $query = 'DELETE FROM farmers WHERE id_farmer=?';
    $stmt = $conn->prepare($query);
    if ($stmt){
        $stmt->bind_param('i', $id_farmer);
        $stmt->execute();
        header("Location: hr.php");
    }
?>