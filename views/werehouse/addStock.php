<?php
    require_once "../../includes/conn.php";
    requireLogin(); 
    $id_user = $_SESSION['id_user'];

    $status_message = ''; 
    $status_type = ''; 

    if (isset($_POST['submit'])){
        $dateFlow = $_POST['dateFlow'];
        $nameCrop = (int)$_POST['nameCrop'];
        $inFlow = (int)$_POST['inFlow'];
        $outFlow = (int)$_POST['outFlow'];

        $errors = array();

        // Validasi yang lebih baik untuk dropdown
        if(empty($dateFlow)) $errors[] = "Tanggal tidak boleh kosong.";
        if(empty($nameCrop)) $errors[] = "Nama tanaman tidak boleh kosong.";
        if(empty($errors)){
            $query = "INSERT INTO storage_flows (date_flow, id_crop, in_flow, out_flow, id_user) VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($query);

            if($stmt){
                $stmt->bind_param('siiii', $dateFlow, $nameCrop, $inFlow, $outFlow, $id_user);

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
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah | Pencatatan Gudang</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary-green text-white text-center">
                <h2>Tambah | Pencatatan Gudang</h2>
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
                <form action="addStock.php" method="post">
                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label for="dateFlow" class="form-label">Tanggal:</label>
                        <input type="date" class="form-control" id="dateFlow" name="dateFlow" required>
                    </div>

                    <!-- Tanaman -->
                    <div class="mb-3">
                        <label for="nameCrop" class="form-label">Tanaman</label>
                        <select class="form-select" aria-label="Pilih tanggal bekerja" id="nameCrop" name="nameCrop" required>
                            <option selected value="">Pilih di sini</option>
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
                    <div class="mb-3">
                        <label for="inFlow" class="form-label">Masuk</label>
                        <input type="number" class="form-control" id="inFlow" name="inFlow" placeholder="Masuk" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="outFlow" class="form-label">Keluar</label>
                        <input type="number" class="form-control" id="outFlow" name="outFlow" placeholder="Keluar" min="0">
                    </div>
                    <div class="d-flex justify-content-end gap-3">
                        <a href="werehouse.php" class="btn btn-secondary">← Kembali</a>
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