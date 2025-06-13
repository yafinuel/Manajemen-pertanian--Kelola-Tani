<?php
    require_once "../../includes/conn.php";
    requireLogin();

    if (isset($_POST['submit'])){
        $name = htmlspecialchars(trim($_POST['name_farm']));
        $type = htmlspecialchars(trim($_POST['type_farm']));
        $area = (int)$_POST['area_farm'];
        $id_user = $_SESSION['id_user'];

        $query = "INSERT INTO farms (name_farm, type_farm, area_farm, id_user) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($query);

        if($stmt){
            $stmt->bind_param('ssii', $name, $type, $area, $id_user);
            
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
    <title>Add Farm | Kelola tani</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary-green text-white text-center">
                <h2>Add Data</h2>
            </div>
            
            <?php if (!empty($status_message)): ?>
                <div class="alert alert-<?php echo $status_type; ?> alert-dismissible fade show" role="alert">
                    <div class="d-flex justify-content-between">
                        <?php echo $status_message; ?>
                        <a href="farm.php" class="alert-link">
                            <button type="button" class="btn" >See the data</button>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card-body">
                <form action="addFarm.php" method="post">
                    <div class="mb-3">
                        <label for="name_farm" class="form-label">Nama pertanian:</label>
                        <input type="text" class="form-control" id="name_farm" name="name_farm" placeholder="Masukkan nama lahan">
                    </div>
                    <div class="mb-3">
                        <label for="type_farm" class="form-label">Tipe tanah:</label>
                        <input type="text" class="form-control" id="type_farm" name="type_farm" placeholder="Masukkan tipe tanah">
                    </div>
                    <div class="mb-3">
                        <label for="area_farm" class="form-label">Luas tanah (m<sup>2</sup>):</label>
                        <input type="number" class="form-control" id="area_farm" name="area_farm" placeholder="Besaran luas tanah" min="0">
                    </div>
                    <div class="d-flex justify-content-end gap-3">
                        <a href="farm.php" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary-green text-light" name="submit">Tambahkan data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>