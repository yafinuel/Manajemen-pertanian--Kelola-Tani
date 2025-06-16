<?php
    require_once "../../includes/conn.php";
    include_once "../../includes/showData.php";
    requireLogin(); 

    
    if(!isset($_GET['id'])){
        header("Location: settings.php?page=tanaman");
        exit();
    }
    $id_user = $_SESSION['id_user'];
    $id_crop = $_GET['id'];


    if(isset($_POST['submit'])){
        $nameCropUpdate = $_POST['nameCrop'];

        $queryUpdate = 'UPDATE crops
                        SET name_crop = ?
                        WHERE id_user = ? AND id_crop = ?';
        $stmtUpdate = $conn->prepare($queryUpdate);
        $stmtUpdate->bind_param("sii",$nameCropUpdate, $id_user, $id_crop);
        $stmtUpdate->execute();
        $stmtUpdate->close();
        header("Location: settings.php?page=tanaman");
        exit();
    }

    $querySelect = 'SELECT id_crop, name_crop
            FROM crops
            WHERE id_user = ? AND id_crop = ?';
    $stmtSelect = $conn->prepare($querySelect);
    $stmtSelect->bind_param("ii", $id_user, $id_crop);
    $stmtSelect->execute();
    $resultSelect = $stmtSelect->get_result();

    $dataSelect = $resultSelect->fetch_assoc();

    $nameCrop = $dataSelect['name_crop'];
    $stmtSelect->close()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit | Tanaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body class="bg-light">

    <div class="container-sm mt-5" style="width: 70%">
        <div class="card shadow">
            <div class="card-header bg-primary-green text-white text-center">
                <h2>Edit | Tanaman</h2>
            </div>
            
                <form action="editTanaman.php?id=<?php echo $id_crop;?>" method="post" class="p-4 ">
                    <div class="mb-3">
                        <label for="nameCrop" class="form-label">Tanaman</label>
                        <input type="text" class="form-control" id="nameCrop" name="nameCrop" value='<?php echo $nameCrop;?>'>
                    </div>
                    <div class="d-flex justify-content-end gap-3">
                        <a href="settings.php?page=tanaman" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary-green text-light" name="submit">Edit data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>