<?php
    require_once "../../includes/conn.php";
    include_once "../../includes/showData.php";
    requireLogin(); 
    $id_user = $_SESSION['id_user'];
    $show = new ShowData($conn, $_SESSION['id_user']); 

    $data = $show->showDataCrops("");
    $showData = $data['textHTML'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/css/settings.css?v=1.2">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
    
</head>
<body>
    <h2 class="fs-5 mb-5">Tanaman</h2>
    <h3 class="fs-6">Daftar tanaman</h3>
    <div class="table-responsive">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col col-no">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                echo $showData = $data['textHTML'];
                ?>
            </tbody>
        </table>
    </div>

    <h3 class="fs-6 mt-4 mb-2">Tambah tanaman</h3>
    <form action="settings.php?page=tanaman" method="post">
        <div class="mb-3">
            <label for="nameCrop" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nameCrop" name="nameCrop" placeholder="Jenis tanaman" required>
        </div>
        <div class="d-flex justify-content-start gap-3">
            <button type="submit" class="btn btn-primary-green text-light" name="submit">Tambahkan data</button>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>