<?php
    require_once "../../includes/conn.php";
    requireLogin(); 
    $id_user = $_SESSION['id_user'];

    $status_message = ''; 
    $status_type = ''; 

    if (isset($_POST['submit'])){
        $id_planting_selected = (int)$_POST['date_aw'];
        $farm_selected = (int)$_POST['name_farm'];
        $farmer_selected = (int)$_POST['name_farmer'];

        $getDateQuery = "SELECT date_planting FROM farm_planting WHERE id_planting = ? AND id_user = ?";
        $getDateStmt = $conn->prepare($getDateQuery);
        
        $getDateStmt->bind_param('ii', $id_planting_selected, $id_user); // Perbaikan: gunakan $id_planting_selected
        $getDateStmt->execute();
        $getDateResult = $getDateStmt->get_result();
        $dateRow = $getDateResult->fetch_assoc();
        $date_for_db = $dateRow['date_planting'] ?? null; // Gunakan null coalescing operator

        $errors = array();

        // Validasi yang lebih baik untuk dropdown
        if(empty($id_planting_selected)) $errors[] = "Tanggal bekerja tidak boleh kosong."; 
        if(empty($farm_selected)) $errors[] = "Lahan pertanian tidak boleh kosong.";
        if(empty($farmer_selected)) $errors[] = "Pekerja tidak boleh kosong.";
        if(is_null($date_for_db)) $errors[] = "Tanggal penanaman tidak valid."; 

        if(empty($errors)){
            $query = "INSERT INTO active_workers (date_aw, id_farm, id_farmer, id_user) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($query);

            if($stmt){
                $stmt->bind_param('siii', $date_for_db, $farm_selected, $farmer_selected, $id_user);

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
        } else {
            $status_message = implode("<br>", $errors);
            $status_type = 'danger';
        }
        $getDateStmt->close(); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah | Aktivitas Pekerja</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary-green text-white text-center">
                <h2>Tambah | Aktivitas Pekerja</h2>
            </div>

            <?php if (!empty($status_message)): ?>
                <div class="alert alert-<?php echo $status_type; ?> alert-dismissible fade show" role="alert">
                    <div class="d-flex justify-content-between">
                        <?php echo $status_message; ?>
                        <a href="hr.php" class="alert-link">
                            <button type="button" class="btn" >Lihat data</button>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card-body">
                <form action="addAw.php" method="post">
                    <div class="mb-3">
                        <label for="date_aw" class="form-label">Tanggal bekerja:</label>
                        <select class="form-select" aria-label="Pilih tanggal bekerja" id="date_aw" name="date_aw" required>
                            <option selected value="">Pilih di sini</option>
                            <?php
                                $cfp_query = 'SELECT id_planting, date_planting FROM farm_planting WHERE id_user = ? ORDER BY date_planting DESC'; // Urutkan agar lebih rapi
                                $cfp_stmt = $conn->prepare($cfp_query);
                                $cfp_stmt->bind_param('i',$id_user);
                                $cfp_stmt->execute();
                                $cfp_result = $cfp_stmt->get_result();
                                if ($cfp_result->num_rows > 0 ){
                                    while($cfp_row = mysqli_fetch_assoc($cfp_result)){
                                        $id = $cfp_row['id_planting'];
                                        echo "<option value='$id'>".$cfp_row['date_planting']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name_farm" class="form-label">Lahan pertanian</label>
                        <select class="form-select" aria-label="Pilih lahan pertanian" id="name_farm" name="name_farm" required>
                            <option selected value="">Pilih tanggal dulu</option>
                            </select>
                    </div>
                    <div class="mb-3">
                        <label for="name_farmer" class="form-label">Pekerja</label>
                        <select class="form-select" aria-label="Pilih pekerja" id="name_farmer" name="name_farmer" required>
                            <option selected value="">Pilih di sini</option>
                            <?php
                                $cw_query = 'SELECT id_farmer, name_farmer FROM farmers WHERE id_user = ?';
                                $cw_stmt = $conn->prepare($cw_query);
                                $cw_stmt->bind_param('i',$id_user);
                                $cw_stmt->execute();
                                $cw_result = $cw_stmt->get_result();
                                if ($cw_result->num_rows > 0 ){
                                    while($cw_row = mysqli_fetch_assoc($cw_result)){
                                        $id = $cw_row['id_farmer'];
                                        echo "<option value='$id'>".$cw_row['name_farmer']."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end gap-3">
                        <a href="hr.php" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary-green text-light" name="submit">Tambahkan data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../assets/js/addAw.js"></script>
</body>
</html>