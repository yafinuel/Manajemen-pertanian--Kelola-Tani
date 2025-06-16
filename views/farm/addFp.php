<?php
    require_once "../../includes/conn.php";
    requireLogin();
    $id_user = $_SESSION['id_user'];

    if (isset($_POST['submit'])){
        $datePlanting = $_POST['dateFp'];
        $idFarm = $_POST['farmFp'];
        $idCrop = $_POST['cropFp'];

        $query = "INSERT INTO farm_planting(date_planting, id_farm, id_crop, id_user)
                VALUES (?,?,?,?)";
        $stmt = $conn->prepare($query);
        
        if($stmt){
            $stmt->bind_param('siii', $datePlanting, $idFarm, $idCrop, $id_user);
            
            if ($stmt->execute()){
                $status_message = 'Data berhasil ditambahkan';
                $status_type = 'success';
            } else {
                $status_message = "Error saat insert data: " . $stmt->error;
                $status_type = 'danger';
            }
            $stmt->close();
        } else {
            $status_message = "Error mempersiapkan insert statement: " . $conn->error;
            $status_type = 'danger';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah | Penanaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary-green text-white text-center">
                <h2>Tambah | Penanaman</h2>
            </div>
            
            <?php if (!empty($status_message)): ?>
                <div class="alert alert-<?php echo $status_type; ?> alert-dismissible fade show" role="alert">
                    <div class="d-flex justify-content-between">
                        <?php echo $status_message; ?>
                        <a href="farm.php" class="alert-link">
                            <button type="button" class="btn" >Lihat data</button>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card-body">
                <form action="addFp.php" method="post">
                    <div class="mb-3">
                        <label for="dateFp" class="form-label">Tanggal:</label>
                        <input type="date" class="form-control" id="dateFp" name="dateFp" required>
                    </div>

                    <div class="mb-3">
                        <label for="farmFp" class="form-label">Lahan pertanian</label>
                        <select class="form-select" aria-label="Pilih lahan pertanian" id="farmFp" name="farmFp" required>
                            <option selected>Pilih lahan pertanian disini</option>
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
                                        echo "<option value=".$farmRow['id_farm'].">".$farmRow['name_farm']."</option>";
                                    }
                                }
                                ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="cropFp" class="form-label">Tanaman</label>
                        <select class="form-select" aria-label="Pilih tanaman" id="cropFp" name="cropFp" required>
                            <option selected>Pilih tanaman disini</option>
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
                                        echo "<option value='".$cropRow['id_crop']."'>".$cropRow['name_crop']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <a href="farm.php" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary-green text-light" name="submit">Tambah data</button>
                    </div>
                </form>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>