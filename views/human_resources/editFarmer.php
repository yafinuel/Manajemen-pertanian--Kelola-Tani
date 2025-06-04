<?php
    require_once "../../includes/conn.php";


    if(!isset($_GET['id'])){
        header("Location: hr.php");
        exit();
    }

    $farmer_id = $_GET['id'];

    if (isset($_POST['submit'])){
        $iname = htmlspecialchars(trim($_POST['name_farmer']));
        $ibirthday = htmlspecialchars(trim($_POST['birthday_farmer']));
        $irole = htmlspecialchars(trim($_POST['role_farmer']));
        $iwage = (int)$_POST['wage_farmer'];

        $query_update = 'UPDATE farmers SET
                                name_farmer = ?,
                                birthday_farmer = ?,
                                role_farmer = ?,
                                wage_farmer = ?
                         WHERE id_farmer = ?';
        $stmt_update = $conn->prepare($query_update);

        if($stmt_update){
            $stmt_update->bind_param('sssii', $iname, $ibirthday, $irole, $iwage, $farmer_id);
            
            if ($stmt_update->execute()){
                $status_message = 'Data petani berhasil diubah!';
                $status_type = 'success';
                $name_select = $iname;
                $birthday_select = $ibirthday;
                $role_select = $irole;
                $wage_select = $iwage;

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

    $query_select = "SELECT id_farmer, name_farmer, birthday_farmer, role_farmer, wage_farmer FROM farmers WHERE id_farmer = ?";
    $stmt_select = $conn->prepare($query_select);

    if ($stmt_select) {
        $stmt_select->bind_param('i', $farmer_id);
        $stmt_select->execute();
        $result_select = $stmt_select->get_result();

        if($result_select->num_rows === 1){
            $data_from_db = $result_select->fetch_assoc(); 
            if (empty($status_message) || $status_type == 'danger') { 
                $id_farmer = (int) $data_from_db['id_farmer'];
                $name_select = htmlspecialchars($data_from_db['name_farmer']);
                $birthday_select = htmlspecialchars($data_from_db['birthday_farmer']);
                $role_select = htmlspecialchars($data_from_db['role_farmer']);
                $wage_select = (int) $data_from_db['wage_farmer'];
            }
        } else {
            header("Location: hr.php");
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
    <title>Edit Farmer</title>
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
                <form action="editFarmer.php?id=<?php echo $farmer_id ;?>" method="post">
                    <div class="mb-3">
                        <label for="name_farmer" class="form-label">Nama:</label>
                        <input type="text" class="form-control" id="name_farmer" name="name_farmer" placeholder="Masukkan nama" value='<?php echo $name_select;?>'>
                    </div>
                    <div class="mb-3">
                        <label for="birthday_farmer" class="form-label">Tanggal Lahir:</label>
                        <input type="date" class="form-control" id="birthday_farmer" name="birthday_farmer" value='<?php echo $birthday_select;?>'>
                    </div>
                    <div class="mb-3">
                        <label for="role_farmer" class="form-label">Role:</label>
                        <input type="text" class="form-control" id="role_farmer" name="role_farmer" placeholder="Masukkan role" value='<?php echo $role_select;?>'>
                    </div>
                    <div class="mb-3">
                        <label for="wage_farmer" class="form-label">Wage:</label>
                        <input type="number" class="form-control" id="wage_farmer" name="wage_farmer" placeholder="Masukkan gaji" min="0" value='<?php echo $wage_select;?>'>
                    </div>
                    <div class="d-flex justify-content-end gap-3">
                        <a href="hr.php" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary-green text-light" name="submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>