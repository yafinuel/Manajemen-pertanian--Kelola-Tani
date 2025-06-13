<?php
    require_once "../../includes/conn.php";
    requireLogin();

    if(!isset($_GET['id'])){
        header("Location: farm.php");
        exit();
    }
    $id_user = $_SESSION['id_user'];
    $id_fp = $_GET['id'];

    // SELECT PLANTING
    $selectQuery = "SELECT id_planting, date_planting, id_farm, id_crop
                FROM farm_planting 
                WHERE id_user = ? and id_planting = ?";
    $selectStmt = $conn->prepare($selectQuery);

    if($selectStmt){
        $selectStmt->bind_param('ii', $id_user, $id_fp);
        $selectStmt->execute();
        $selectResult = $selectStmt->get_result();
        if ($selectResult->num_rows == 1 ){
            $selectData = $selectResult->fetch_assoc();
            $selectId = $selectData['id_planting'];
            $selectDate = $selectData['date_planting'];
            $selectIdFarm = $selectData['id_farm'];
            $selectIdCrop = $selectData['id_crop'];
        } else {
            $status_message = "Tidak ada data yang terambil" . $conn->error;
        }
    } else {
        $status_message = "Error mempersiapkan selectStmt: " . $conn->error;
        $status_type = 'danger';
    }
    // END SELECT PLANTING

    // UPDATE
    if(isset($_POST['submit'])){
        $updateDate = $_POST["dateFp"];
        $updateFarm = $_POST["farmFp"];
        $updateCrop = $_POST["cropFp"];

    // Cek active workers
    $awSelectQuery = "SELECT id_aw, date_aw, id_farm
                    FROM active_workers
                    WHERE date_aw = ? and id_farm = ? and id_user = ?";
    $awSelectStmt = $conn->prepare($awSelectQuery);
    $awSelectStmt->bind_param("sii", $selectDate, $selectIdFarm, $id_user);
    $awSelectStmt->execute();
    $awSelectResult = $awSelectStmt->get_result();

    if($awSelectResult->num_rows > 0 ){
        $awEditQuery = "UPDATE active_workers 
                        SET date_aw = ?,
                            id_farm = ?
                        WHERE date_aw = ? and id_farm = ? and id_user = ?";
        $awEditstmt = $conn->prepare($awEditQuery);
        if ($awEditstmt){
            $awEditstmt->bind_param("sisii",$updateDate,$updateFarm ,$selectDate, $selectIdFarm, $id_user);
            $awEditstmt->execute();
        }
    }

        $updateQuery = "UPDATE farm_planting
                SET date_planting = ?,
                    id_farm = ?,
                    id_crop = ?
                WHERE id_planting = ? and id_user = ?";
        $updateStmt = $conn->prepare($updateQuery);

        if($updateStmt){
            $updateStmt->bind_param('siiii', $updateDate, $updateFarm, $updateCrop, $id_fp, $id_user);
            if ($updateStmt->execute()){
                $status_message = 'Data pertanian berhasil diubah!';
                $status_type = 'success';
            }
            
        } else {
        $status_message = "Error mempersiapkan selectStmt: " . $conn->error;
        $status_type = 'danger';
    }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit | Active Worker</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQffpRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary-green text-white text-center">
                <h2>Edit Data</h2>
            </div>
            
            <?php if (!empty($status_message)): ?>
                <div class="alert alert-<?php echo $status_type; ?> alert-dismissible fade show" role="alert">
                    <?php echo $status_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card-body">
                <form action="editFp.php?id=<?php echo $id_fp;?>" method="post">
                    <div class="mb-3">
                        <label for="dateFp" class="form-label">Tanggal:</label>
                        <input type="date" class="form-control" id="dateFp" name="dateFp" value="<?php echo $selectDate;?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="farmFp" class="form-label">Lahan pertanian</label>
                        <select class="form-select" aria-label="Pilih lahan pertanian" id="farmFp" name="farmFp" required>
                            <?php
                                $farmQuery = 'SELECT id_farm, name_farm, id_user
                                            FROM farms
                                            WHERE id_user = ?';
                                $farmStmt = $conn->prepare($farmQuery);
                                $farmStmt->bind_param('i',$id_user);
                                $farmStmt->execute();
                                $farmResult = $farmStmt->get_result();
                                if($farmResult->num_rows > 0){
                                    while($farmRow = mysqli_fetch_assoc($farmResult)){
                                        if($farmRow['id_farm'] == $selectIdFarm){
                                            echo "<option value=".$farmRow['id_farm']." selected>".$farmRow['name_farm']."</option>";
                                        } else {
                                            echo "<option value=".$farmRow['id_farm'].">".$farmRow['name_farm']."</option>";
                                        }
                                    }
                                }
                                ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="cropFp" class="form-label">Tanaman</label>
                        <select class="form-select" aria-label="Pilih tanaman" id="cropFp" name="cropFp" required>
                            <?php
                                $cropQuery = 'SELECT id_crop, name_crop, id_user
                                            FROM crops
                                            WHERE id_user = ?';
                                $cropStmt = $conn->prepare($cropQuery);
                                $cropStmt->bind_param('i',$id_user);
                                $cropStmt->execute();
                                $cropResult = $cropStmt->get_result();
                                if ($cropResult->num_rows > 0 ){
                                    while($cropRow = mysqli_fetch_assoc($cropResult)){
                                        if($cropRow['id_crop'] == $selectIdCrop){
                                            echo "<option value='".$cropRow['id_crop']."' selected>".$cropRow['name_crop']."</option>";
                                        } else {
                                            echo "<option value='".$cropRow['id_crop']."'>".$cropRow['name_crop']."</option>";
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <a href="farm.php" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary-green text-light" name="submit">Edit data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../assets/js/addfp.js"></script>
</body>
</html>