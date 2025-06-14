<?php
    require_once "../../includes/conn.php";
    requireLogin();
    
    $id_user = $_SESSION['id_user'];

    if(!isset($_GET['id'])){
        header("Location: werehouse.php");
        exit();
    }
    
    $id_flow = $_GET['id'];
    $query = 'DELETE FROM storage_flows WHERE id_flow =? and id_user = ?';
    $stmt = $conn->prepare($query);
    if ($stmt){
        $stmt->bind_param('ii', $id_flow, $id_user);
        $stmt->execute();
        header("Location: werehouse.php");
    }
?>