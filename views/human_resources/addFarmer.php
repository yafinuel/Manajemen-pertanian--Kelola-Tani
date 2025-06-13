<?php
    require_once "../../includes/conn.php";
    requireLogin();

    if (isset($_POST['submit'])){
        $name = htmlspecialchars(trim($_POST['name_farmer']));
        $birthday = htmlspecialchars(trim($_POST['birthday_farmer']));
        $role = htmlspecialchars(trim($_POST['role_farmer']));
        $wage = (int)$_POST['wage_farmer'];
        $id_user = $_SESSION['id_user'];

        $errors = array();
        
        if(empty($name)) $errors[] = "Nama tidak boleh kosong";
        if(empty($birthday)) $errors[] = "Tanggal lahir tidak boleh kosong";
        if(empty($role)) $errors[] = "Role tidak boleh kosong";
        if(empty($wage)) $errors[] = "Gaji tidak boleh kosong";

        if(empty($errors)){
            $query = "INSERT INTO farmers (name_farmer, birthday_farmer, role_farmer, wage_farmer, id_user) VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($query);
    
            if($stmt){
                $stmt->bind_param('sssii', $name, $birthday, $role, $wage, $id_user);
                
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
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Farmer</title>
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
                        <a href="hr.php" class="alert-link">
                            <button type="button" class="btn" >Lihat data</button>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card-body">
                <form action="addFarmer.php" method="post">
                    <div class="mb-3">
                        <label for="name_farmer" class="form-label">Nama:</label>
                        <input type="text" class="form-control" id="name_farmer" name="name_farmer" placeholder="Masukkan nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="birthday_farmer" class="form-label">Tanggal Lahir:</label>
                        <input type="date" class="form-control" id="birthday_farmer" name="birthday_farmer" required>
                    </div>
                    <div class="mb-3">
                        <label for="role_farmer" class="form-label">Role:</label>
                        <input type="text" class="form-control" id="role_farmer" name="role_farmer" placeholder="Masukkan role" required>
                    </div>
                    <div class="mb-3">
                        <label for="wage_farmer" class="form-label">Upah/hari:</label>
                        <input type="number" class="form-control" id="wage_farmer" name="wage_farmer" placeholder="Masukkan gaji" min="0" required>
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
</body>
</html>