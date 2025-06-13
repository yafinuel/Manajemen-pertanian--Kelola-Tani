<?php
    require_once "../../includes/conn.php";
    requireLogin();
    
    $id_user = $_SESSION['id_user'];

    if(!isset($_GET['id'])){
        header("Location: farm.php");
        exit();
    }
    
    $idPlanting = $_GET['id'];

    // Cek active workers
    // Ambil data tanggal dan farm planting dulu
    $plantingSelectQuery = "SELECT date_planting, id_farm
                        FROM farm_planting
                        WHERE id_planting = ? and id_user = ?";
    $plantingStmt = $conn->prepare($plantingSelectQuery);
    $plantingStmt->bind_param("ii", $idPlanting, $id_user);
    $plantingStmt->execute();
    $plantingResult = $plantingStmt->get_result();
    $plantingData = $plantingResult->fetch_assoc();

    $plantingDate = $plantingData['date_planting'];
    $plantingFarm = $plantingData['id_farm'];

    $awSelectQuery = "SELECT id_aw, date_aw, id_farm
                    FROM active_workers
                    WHERE date_aw = ? and id_farm = ? and id_user = ?";
    $awSelectStmt = $conn->prepare($awSelectQuery);
    $awSelectStmt->bind_param("sii", $plantingDate, $plantingFarm, $id_user);
    $awSelectStmt->execute();
    $awSelectResult = $awSelectStmt->get_result();

    if($awSelectResult->num_rows > 0 ){
        $awDelQuery = "DELETE FROM active_workers WHERE date_aw = ? and id_farm = ? and id_user = ?";
        $awDelstmt = $conn->prepare($awDelQuery);
        if ($awDelstmt){
            $awDelstmt->bind_param("sii", $plantingDate, $plantingFarm, $id_user);
            $awDelstmt->execute();
        }
    }
    $plantingDelQuery = "DELETE FROM farm_planting WHERE id_planting = ? and id_user = ?";
    $plantingDelstmt = $conn->prepare($plantingDelQuery);
    if ($plantingDelstmt){
        $plantingDelstmt->bind_param("ii", $idPlanting, $id_user);
        $plantingDelstmt->execute();
        header("Location: farm.php");
    }

?>