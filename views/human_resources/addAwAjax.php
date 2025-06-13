<?php
// addAwAjax.php

require_once "../../includes/conn.php";
requireLogin();
$id_user = $_SESSION['id_user'];

$id_planting_from_ajax = $_POST['id_planting'] ?? '';

if (empty($id_planting_from_ajax)) {
    echo '<option selected value="">Pilih tanggal dulu</option>'; 
    exit();
}

$queryFarms = "SELECT DISTINCT f.id_farm, f.name_farm
               FROM farms f
               INNER JOIN farm_planting fp ON f.id_farm = fp.id_farm
               WHERE fp.id_planting = ? AND fp.id_user = ?"; 

$stmtFarms = $conn->prepare($queryFarms);
if ($stmtFarms === false) {
    echo '<option value="">Error DB</option>';
    error_log("Prepare failed: " . $conn->error);
    exit();
}

$stmtFarms->bind_param("ii", $id_planting_from_ajax, $id_user); 
$stmtFarms->execute();
$resultFarms = $stmtFarms->get_result();

$options_html = ''; 

if ($resultFarms->num_rows > 0) {
    while ($rowFarm = $resultFarms->fetch_assoc()) {
        $options_html .= "<option value='{$rowFarm['id_farm']}'>{$rowFarm['name_farm']}</option>";
    }
} else {
    $options_html .= '<option value="">Tidak ada lahan tersedia</option>';
}

echo $options_html; 

$stmtFarms->close();
$conn->close();
?>