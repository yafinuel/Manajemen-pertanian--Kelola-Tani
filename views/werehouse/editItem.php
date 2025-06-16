<?php
    require_once "../../includes/conn.php";
    requireLogin();

    if(!isset($_GET['id'])){
        header("Location: werehouse.php");
        exit();
    }
    $id_user = $_SESSION['id_user'];
    $id_storage = $_GET['id'];

    // SELECT STORAGE
    $selectQuery = "SELECT id_storage, id_crop, volume_storage
                FROM storages 
                WHERE id_user = ? and id_storage = ?";
    $selectStmt = $conn->prepare($selectQuery);

    if($selectStmt){
        $selectStmt->bind_param('ii', $id_user, $id_storage);
        $selectStmt->execute();
        $selectResult = $selectStmt->get_result();
        if ($selectResult->num_rows == 1 ){
            $selectData = $selectResult->fetch_assoc();
            $selectId = $selectData['id_storage'];
            $selectIdCrop = $selectData['id_crop'];
            $selectVolume = $selectData['volume_storage'];
        } else {
            $status_message = "Tidak ada data yang terambil" . $conn->error;
        }
    } else {
        $status_message = "Error mempersiapkan selectStmt: " . $conn->error;
        $status_type = 'danger';
    }
    // END SELECT STORAGE

    // UPDATE
    if(isset($_POST['submit'])){
        $updateCrop = $_POST["cropstorage"];
        $updateVolume = $_POST["volumeStorage"];

        $updateQuery = "UPDATE storages
                        SET id_crop = ?,
                            volume_storage = ?
                        WHERE id_storage = ? and id_user = ?";
        $updateStmt = $conn->prepare($updateQuery);

        if($updateStmt){
            $updateStmt->bind_param('iiii',$updateCrop, $updateVolume, $id_storage, $id_user);
            if ($updateStmt->execute()){
                $status_message = 'Data gudang berhasil diubah!';
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
    <title>Edit | Gudang</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfstorageRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary-green text-white text-center">
                <h2>Edit | Gudang</h2>
            </div>
            
            <?php if (!empty($status_message)): ?>
                <div class="alert alert-<?php echo $status_type; ?> alert-dismissible fade show" role="alert">
                    <div class="d-flex justify-content-between">
                        <?php echo $status_message; ?>
                        <a href="werehouse.php" class="alert-link">
                            <button type="button" class="btn" >Lihat data</button>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card-body">
                <form action="editItem.php?id=<?php echo $id_storage;?>" method="post">
                    <div class="mb-3">
                        <div class="mb-3">
                        <label for="cropstorage" class="form-label">Tanaman</label>
                        <select class="form-select" aria-label="Pilih tanaman" id="cropstorage" name="cropstorage" required>
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

                    
                    <div class="mb-3">
                        <label for="volumeStorage" class="form-label">Penyesuaian Volume</label>
                        <input type="number" class="form-control" id="volumeStorage" name="volumeStorage" placeholder="Volume" value="<?php echo $selectVolume;?>" min="0">
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <a href="werehouse.php" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary-green text-light" name="submit">Edit data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../assets/js/addstorage.js"></script>
</body>
</html>