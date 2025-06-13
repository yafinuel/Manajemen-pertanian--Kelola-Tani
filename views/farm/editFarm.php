<?php
    require_once "../../includes/conn.php";
    requireLogin();

    if(!isset($_GET['id'])){
        header("Location: farm.php");
        exit();
    }

    $id_user = $_SESSION['id_user'];

    $id_farm = $_GET['id'];

    if (isset($_POST['submit'])){
        $iname = htmlspecialchars(trim($_POST['name_farm']));
        $itype = htmlspecialchars(trim($_POST['type_farm']));
        $iarea = (int)$_POST['area_farm'];

        $query_update = 'UPDATE farms SET
                                name_farm = ?,
                                type_farm = ?,
                                area_farm = ?
                         WHERE id_farm = ? and id_user = ?';
        $stmt_update = $conn->prepare($query_update);

        if($stmt_update){
            $stmt_update->bind_param('ssiii', $iname, $itype, $iarea, $id_farm, $id_user);
            
            if ($stmt_update->execute()){
                $status_message = 'Data pertanian berhasil diubah!';
                $status_type = 'success';
                $name_select = $iname;
                $type_select = $itype;
                $area_select = $iarea;

            } else {
                $status_message = "Error saat mengupdate data: " . $stmt_update->error;
                $status_type = 'danger';
            }
            $stmt_update->close();
        } else {
            $status_message = "Error mempersiapkan update statement: " . $conn->error;
            $status_type = 'danger';
        }
    }

    $query_select = "SELECT id_farm, name_farm, type_farm, area_farm FROM farms WHERE id_farm = ? and id_user = ?";
    $stmt_select = $conn->prepare($query_select);

    if ($stmt_select) {
        $stmt_select->bind_param('ii', $id_farm, $id_user);
        $stmt_select->execute();
        $result_select = $stmt_select->get_result();

        if($result_select->num_rows === 1){
            $data_from_db = $result_select->fetch_assoc(); 
            if (empty($status_message) || $status_type == 'danger') { 
                $id_farm = (int) $data_from_db['id_farm'];
                $name_select = htmlspecialchars($data_from_db['name_farm']);
                $type_select = htmlspecialchars($data_from_db['type_farm']);
                $area_select = (int) $data_from_db['area_farm'];
            }
        } else {
            header("Location: farm.php");
            exit();
        }
        $stmt_select->close();
    } else {
        echo "Error persiapan select:". $conn->error;
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Farm | Kelola tani</title>
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
                <form action="editFarm.php?id=<?php echo $id_farm ;?>" method="post">
                    <div class="mb-3">
                        <label for="name_farm" class="form-label">Nama pertanian:</label>
                        <input type="text" class="form-control" id="name_farm" name="name_farm" placeholder="Masukkan nama pertanian baru" value='<?php echo $name_select;?>'>
                    </div>
                    <div class="mb-3">
                        <label for="type_farm" class="form-label">Tipe tanah:</label>
                        <input type="text" class="form-control" id="type_farm" name="type_farm" value='<?php echo $type_select;?>'>
                    </div>
                    <div class="mb-3">
                        <label for="area_farmer" class="form-label">Luas lahan:</label>
                        <input type="number" class="form-control" id="area_farm" name="area_farm" placeholder="Masukkan luas lahan" min="0" value='<?php echo $area_select;?>'>
                    </div>
                    <div class="d-flex justify-content-end gap-3">
                        <a href="farm.php" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary-green text-light" name="submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>