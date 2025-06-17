<?php
require_once "../../includes/conn.php";
requireLogin();

if (!isset($_GET['id'])) {
    header("Location: home.php");
    exit();
}

$id_user = $_SESSION['id_user'] ?? null;
$id_wn = (int)$_GET['id']; 

$pesan_alert = '';
$dataSelect = null; 

if (isset($_POST['submit'])) {
    $dateWn = $_POST['dateWn'];
    $volume = (int)$_POST['volume'];
    $idCrop = (int)$_POST['idCrop'];

    $errors = [];
    if (empty($dateWn)) $errors[] = "Tanggal tidak boleh kosong.";
    if ($volume <= 0) $errors[] = "Volume harus lebih dari 0.";
    if ($idCrop <= 0) $errors[] = "Tanaman belum dipilih.";

    if (!empty($errors)) {
        $pesan_alert = implode(", ", $errors);
    } else {
        $querySelectStorage = "SELECT * FROM storages WHERE id_user = ? AND id_crop = ?";
        $storageStmt = $conn->prepare($querySelectStorage);
        if ($storageStmt === false) {
            error_log("Error mempersiapkan select statement storages: " . $conn->error);
            $pesan_alert = "Terjadi kesalahan sistem (storage_check_prep).";
        } else {
            $storageStmt->bind_param("ii", $id_user, $idCrop);
            $storageStmt->execute();
            $resultStorage = $storageStmt->get_result();
            $storageStmt->close();

            if ($resultStorage->num_rows > 0) {
                $conn->begin_transaction();

                try {
                    $queryInsert = "INSERT INTO storage_flows(date_flow, id_crop, in_flow, id_user) VALUES (?,?,?,?)";
                    $stmtInsert = $conn->prepare($queryInsert);
                    if ($stmtInsert === false) {
                        throw new Exception("Error mempersiapkan insert statement storage_flows: " . $conn->error);
                    }
                    $stmtInsert->bind_param('siii', $dateWn, $idCrop, $volume, $id_user);
                    if (!$stmtInsert->execute()) {
                        throw new Exception("Error saat insert data ke storage_flows: " . $stmtInsert->error);
                    }
                    $stmtInsert->close();

                    $plantingSelectQuery = "SELECT date_planting, id_farm FROM farm_planting WHERE id_planting = ? AND id_user = ?";
                    $plantingStmt = $conn->prepare($plantingSelectQuery);
                    if ($plantingStmt === false) {
                        throw new Exception("Error mempersiapkan select statement farm_planting: " . $conn->error);
                    }
                    $plantingStmt->bind_param("ii", $id_wn, $id_user);
                    $plantingStmt->execute();
                    $plantingResult = $plantingStmt->get_result();
                    $plantingData = $plantingResult->fetch_assoc();
                    $plantingStmt->close();

                    if (!$plantingData) {
                        throw new Exception("Data tanam tidak ditemukan atau sudah selesai.");
                    }

                    $plantingDate = $plantingData['date_planting'];
                    $plantingFarm = $plantingData['id_farm'];

                    $awSelectQuery = "SELECT id_aw FROM active_workers WHERE date_aw = ? AND id_farm = ? AND id_user = ?";
                    $awSelectStmt = $conn->prepare($awSelectQuery);
                    if ($awSelectStmt === false) {
                        throw new Exception("Error mempersiapkan select statement active_workers: " . $conn->error);
                    }
                    $awSelectStmt->bind_param("sii", $plantingDate, $plantingFarm, $id_user);
                    $awSelectStmt->execute();
                    $awSelectResult = $awSelectStmt->get_result();
                    $awSelectStmt->close();

                    if ($awSelectResult->num_rows > 0) {
                        $awDelQuery = "DELETE FROM active_workers WHERE date_aw = ? AND id_farm = ? AND id_user = ?";
                        $awDelstmt = $conn->prepare($awDelQuery);
                        if ($awDelstmt === false) {
                            throw new Exception("Error mempersiapkan delete statement active_workers: " . $conn->error);
                        }
                        $awDelstmt->bind_param("sii", $plantingDate, $plantingFarm, $id_user);
                        if (!$awDelstmt->execute()) {
                            throw new Exception("Error saat delete data dari active_workers: " . $awDelstmt->error);
                        }
                        $awDelstmt->close();
                    }

                    $plantingDelQuery = "DELETE FROM farm_planting WHERE id_planting = ? AND id_user = ?";
                    $plantingDelstmt = $conn->prepare($plantingDelQuery);
                    if ($plantingDelstmt === false) {
                        throw new Exception("Error mempersiapkan delete statement farm_planting: " . $conn->error);
                    }
                    $plantingDelstmt->bind_param("ii", $id_wn, $id_user);
                    if (!$plantingDelstmt->execute()) {
                        throw new Exception("Error saat delete data dari farm_planting: " . $plantingDelstmt->error);
                    }
                    $plantingDelstmt->close();

                    $conn->commit();
                    header("Location: home.php?status=selesai_panen");
                    exit();

                } catch (Exception $e) {
                    $conn->rollback();
                    error_log("Transaksi selesai panen gagal: " . $e->getMessage());
                    $pesan_alert = "Operasi gagal: " . $e->getMessage();
                }
            } else {
                $pesan_alert = "Buat penyimpanannya dulu di gudang untuk tanaman ini!";
            }
        }
    }
}

$querySelect = "SELECT fp.id_crop, c.name_crop
                FROM farm_planting fp JOIN crops c ON c.id_crop = fp.id_crop
                WHERE fp.id_user = ? AND fp.id_planting = ?";
$stmtSelect = $conn->prepare($querySelect);

if ($stmtSelect === false) {
    error_log("Error mempersiapkan select statement untuk form: " . $conn->error);
    header("Location: home.php?error=db_prepare_failed_form_load");
    exit();
}
$stmtSelect->bind_param('ii', $id_user, $id_wn);
$stmtSelect->execute();
$result = $stmtSelect->get_result();
$dataSelect = $result->fetch_assoc();
$stmtSelect->close();

if (!$dataSelect) {
    header("Location: home.php?error=record_not_found_for_form");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesai | Sedang berjalan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body class="bg-light">
    <?php if (!empty($pesan_alert)): ?>
        <script>
            alert(<?php echo json_encode($pesan_alert); ?>);
        </script>
    <?php endif; ?>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary-green text-white text-center">
                <h2>Selesai | Sedang berjalan</h2>
            </div>

            <div class="card-body">
                <form action="selesaiWn.php?id=<?php echo $id_wn; ?>" method="post">
                    <div class="mb-3">
                        <label for="dateWn" class="form-label">Tanggal:</label>
                        <input type="date" class="form-control" id="dateWn" name="dateWn" required>
                    </div>
                    <div class="mb-3">
                        <label for="crop" class="form-label">Tanaman</label>
                        <input type="text" class="form-control" id="crop" name="crop" value="<?php echo htmlspecialchars($dataSelect["name_crop"]); ?>" disabled>
                        <input type="hidden" class="form-control" id="idCrop" name="idCrop" value="<?php echo htmlspecialchars($dataSelect["id_crop"]); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="volume" class="form-label">Volume</label>
                        <input type="number" class="form-control" id="volume" name="volume" placeholder="Volume" min="0" required>
                    </div>
                    <div class="d-flex justify-content-end gap-3">
                        <a href="home.php" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary-green text-light" name="submit">Tambahkan data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>