<?php
    require_once "../../includes/conn.php";
    requireLogin();
    include_once "../../includes/showData.php";
    include_once "../../includes/funcPagination.php";
    
    $show = new ShowData($conn, $_SESSION['id_user']);     
    
    // Searching
    $search1 = isset($_GET['search1']) ? $_GET['search1'] : '';

    // data pagination untuk Working Now
    $dataWn = $show->showDataWorkingNow($search1);
    $page1 = $dataWn["currentPage"];
    $totalPagesWn = $dataWn["totalPages"];
    $showDataWn = $dataWn["textHTML"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Kelola Tani</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Manrope:wght@200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
    <link rel="stylesheet" href="../../assets/css/home.css?v=1.2">
</head>
<body>
    <!-- Navbar -->
    <?php require_once '../../includes/navbar.php';?>

    <main class="main container d-flex flex-column gap-4 mb-4">
        <h1 class="fw-bold text-primary-green">Dashboard</h1>
       <section class="container-fluid p-3 d-flex gap-3">
           <div class="card mb-3">
                <a href="../human_resources/hr.php">
                    <div class="row g-0 height">
                        <div class="col-md-4">
                            <img src="../../assets/img/human_resources.webp" class="img-fluid rounded-start" alt="..." style="height:100%;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body card-HR">
                                <h5 class="card-title">Human Resources</h5>
                                <p class="card-text for-hidden">Berisi data diri petani dan daftar petani yang sedang bekerja</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="card mb-3">
                <a href="../farm/farm.php">
                    <div class="row g-0 height">
                        <div class="col-md-4">
                            <img src="../../assets/img/farm.webp" class="img-fluid rounded-start" alt="..." style="height:100%;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body card-FR">
                                <h5 class="card-title">Farm</h5>
                                <p class="card-text for-hidden">Berisi daftar lahan pertanian yang dimiliki dan penanaman yang sedang dilakukan</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="card mb-3">
                <a href="../werehouse/werehouse.php">
                    <div class="row g-0 height">
                        <div class="col-md-4">
                            <img src="../../assets/img/werehouse.webp" class="img-fluid rounded-start" alt="..." style="height:100%;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body card-WH">
                                <h5 class="card-title">Werehouse</h5>
                                <p class="card-text for-hidden">Berisi daftar isi gudang dan data aliran keluar dan masuk gudang</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
        
        <section class="container_sect p-4 d-flex flex-column gap-3">
            <div class="d-flex justify-content-between">
                <h2 class="fs-4 fw-bold text-primary-green">Sedang Berjalan</h2>    
            </div>          
            
            <form method="get" class="mb-3 d-flex gap-2">
                <input type="text" name="search1" class="form-control" placeholder="Cari data berdasarkan tanggal, tanaman, dan pertanian" value="<?= htmlspecialchars($search1) ?>">
                <button type="submit" class="btn btn-success">Cari</button>
            </form>

            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Lahan Pertanian</th>
                        <th scope="col">Tanaman</th>
                        <th scope="col" class="text-center">Jumlah pekerja</th>
                        <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $showDataWn;?>
                    </tbody>
                </table>
            </div>
            <?php pagination1($totalPagesWn, $page1, $search1);?>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>