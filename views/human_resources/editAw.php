<?php
    require_once "../../includes/conn.php";
    requireLogin();

    if(!isset($_GET['id'])){
        header("Location: hr.php");
        exit();
    }
    $id_user = $_SESSION['id_user'];
    $id_aw = $_GET['id'];

    if(isset($_POST['submit'])){
        $e_id_planting = (int)$_POST['date_aw'];
        $e_id_farm = (int)$_POST['name_farm'];
        $e_id_farmer = (int)$_POST['name_farmer'];

        $getDateQuery = "SELECT date_planting FROM farm_planting WHERE id_planting = ? AND id_user = ?";
        $getDateStmt = $conn->prepare($getDateQuery);
        $getDateStmt->bind_param('ii', $e_id_planting, $id_user);
        $getDateStmt->execute();
        $getDateResult = $getDateStmt->get_result();
        $dateRow = $getDateResult->fetch_assoc();
        $e_date_aw = $dateRow['date_planting'];

        $e_query = "UPDATE active_workers
                    SET date_aw = ?,
                        id_farm = ?,
                        id_farmer = ?
                    WHERE id_user = ? AND id_aw = ?";
        $e_stmt = $conn->prepare($e_query);

        if ($e_stmt){

            $e_stmt->bind_param('siiii', $e_date_aw, $e_id_farm, $e_id_farmer, $id_user, $id_aw);

            if ($e_stmt->execute()){                
                $status_message = 'Data petani berhasil diubah!';
                $status_type = 'success';
                $s_date_aw = $e_date_aw;
                $s_id_farm = $e_id_farm;
                $s_id_farmer = $e_id_farmer;
            } else {
                $status_message = "Error saat mengupdate data: " . $e_stmt->error;
                $status_type = 'danger';
            }
            $e_stmt->close();
        } else {
            $status_message = "Error mempersiapkan update statement: " . $conn->error;
            $status_type = 'danger';
        }
    }

    $s_query = "SELECT date_aw, id_farm, id_farmer
                FROM active_workers
                WHERE id_user = ? AND id_aw = ?";
    $s_stmt = $conn->prepare($s_query);

    if($s_stmt){
        $s_stmt->bind_param('ii',  $id_user, $id_aw);
        $s_stmt->execute();
        $s_result = $s_stmt->get_result();
        if($s_result->num_rows === 1) {
            $s_data = $s_result->fetch_assoc();
            // Data di fetch_assoc
            $s_date_aw = $s_data['date_aw'];
            $s_id_farm = $s_data['id_farm'];
            $s_id_farmer = $s_data['id_farmer'];
        }
    } else {
        $status_message = "Error mempersiapkan update statement: " . $conn->error;
        $status_type = 'danger';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit | Aktivitas Pekerja</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary-green text-white text-center">
                <h2>Edit | Aktivitas Pekerja</h2>
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
                <form action="editAw.php?id=<?php echo $id_aw;?>" method="post">
                    <div class="mb-3">
                        <label for="date_aw" class="form-label">Tanggal:</label>
                        <!-- <input type="date" class="form-control" id="date_aw" name="date_aw" value="<?php  $s_date_aw;?>" required> -->
                        <select class="form-select" aria-label="Pilih lahan pertanian" id="date_aw" name="date_aw" required>
                            <?php
                                $cfp_query = 'SELECT id_planting, date_planting, id_user
                                            FROM farm_planting
                                            WHERE id_user = ?';
                                $cfp_stmt = $conn->prepare($cfp_query);
                                $cfp_stmt->bind_param('i',$id_user);
                                $cfp_stmt->execute();
                                $cfp_result = $cfp_stmt->get_result();
                                if ($cfp_result->num_rows > 0 ){
                                    while($cfp_row = mysqli_fetch_assoc($cfp_result)){
                                        $id = $cfp_row['id_planting'];
                                        if($s_date_aw  == $cfp_row['date_planting']){
                                            echo "<option value='$id' selected>".$cfp_row['date_planting']."</option>";
                                        } else {
                                            echo "<option value='$id'>".$cfp_row['date_planting']."</option>";
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name_farm" class="form-label">Lahan pertanian</label>
                        <select class="form-select" aria-label="Pilih lahan pertanian" id="name_farm" name="name_farm" required>
                            <?php
                                $cf_query = 'SELECT id_farm, name_farm, id_user
                                            FROM farms
                                            WHERE id_user = ? and id_farm = ?';
                                $cf_stmt = $conn->prepare($cf_query);
                                $cf_stmt->bind_param('is',$id_user,$s_id_farm);
                                $cf_stmt->execute();
                                $cf_result = $cf_stmt->get_result();
                                $data = $cf_result->fetch_assoc();
                                echo "
                                <option value=".$data['id_farm']." selected>".$data['name_farm']."</option>
                                "
                                ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name_farmer" class="form-label">Pekerja</label>
                        <select class="form-select" aria-label="Pilih pekerja" id="name_farmer" name="name_farmer" required>
                            <?php
                                $cw_query = 'SELECT id_farmer, name_farmer, id_user
                                            FROM farmers
                                            WHERE id_user = ?';
                                $cw_stmt = $conn->prepare($cw_query);
                                $cw_stmt->bind_param('i',$id_user);
                                $cw_stmt->execute();
                                $cw_result = $cw_stmt->get_result();
                                if ($cw_result->num_rows > 0 ){
                                    while($cw_row = mysqli_fetch_assoc($cw_result)){
                                        $id = $cw_row['id_farmer'];
                                        if($s_id_farmer == $id){
                                            echo "<option value='$id' selected>".$cw_row['name_farmer']."</option>";
                                        } else {
                                            echo "<option value='$id'>".$cw_row['name_farmer']."</option>";
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <a href="hr.php" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary-green text-light" name="submit">Edit data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../../assets/js/addAw.js"></script>
</body>
</html>