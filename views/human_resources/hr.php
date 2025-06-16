<?php
    require_once "../../includes/conn.php";
    requireLogin();
    include_once "../../includes/showData.php";
    include_once "../../includes/funcPagination.php";

    $show = new ShowData($conn, $_SESSION['id_user']); 
    
    // Searching
    $searchFarmer = isset($_GET['search1']) ? $_GET['search1'] : '';
    $searchActiveFarmer = isset($_GET['search2']) ? $_GET['search2'] : '';

    // data pagination untuk farmer
    $dataFarmer = $show->showDataFarmer($searchFarmer);
    $page1 = $dataFarmer["currentPage"];
    $totalPagesFarmer = $dataFarmer["totalPages"];
    $showDataFarmer = $dataFarmer["textHTML"];

    $dataActiveFarmer = $show->showActiveFarmers($searchActiveFarmer);
    $page2 = $dataActiveFarmer["currentPage"];
    $totalPagesActiveFarmer = $dataActiveFarmer["totalPages"];
    $showDataActiveFarmer = $dataActiveFarmer["textHTML"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Manrope:wght@200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <title>Human Resources | Kelola Tani</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body>
    <!-- Navbar -->
    <?php require_once '../../includes/navbar.php';?>
    
    <main class="main container d-flex flex-column gap-4 mb-4">
        <h1 class="fw-bold text-primary-green">Human Resources</h1>
        
        <section class="container_sect p-4 d-flex flex-column gap-3">
            <div class="d-flex justify-content-between">
                <h2 class="fs-4 fw-bold text-primary-green">Petani Aktif</h2>
                <a href="addAw.php"><button class='btn btn-primary-green text-white fw-bold border-0' >Tambah data</button></a>
            </div>
            <form method="get" class="mb-3 d-flex gap-2">
                <input type="text" name="search2" class="form-control" placeholder="Cari berdasarkan tanggal, nama, role, dan pertanian" value="<?= htmlspecialchars($searchActiveFarmer) ?>">
                <input type="hidden" name="search1" class="form-control" placeholder="Cari nama atau role" value="<?= htmlspecialchars($searchFarmer) ?>">
                <button type="submit" class="btn btn-success">Cari</button>
            </form>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Lahan Pertanian</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $showDataActiveFarmer; ?>
                </tbody>
            </table>
            </div>
            <?php pagination($totalPagesFarmer, $page1, $totalPagesActiveFarmer, $page2,$searchFarmer,$searchActiveFarmer, "2");?>
        </section>

        <section class="container_sect p-4 d-flex flex-column gap-3">
            <div class="d-flex justify-content-between">
                <h2 class="fs-4 fw-bold text-primary-green">Petani/Pekerja  </h2>
                <a href="addFarmer.php">
                    <button class='btn btn-primary-green text-white fw-bold border-0' >Tambah data</button>
                </a>
            </div>
            
            <form method="get" class="mb-3 d-flex gap-2">
                <input type="text" name="search1" class="form-control" placeholder="Cari nama atau role" value="<?= htmlspecialchars($searchFarmer) ?>">
                <input type="hidden" name="search2" class="form-control" placeholder="Cari berdasarkan tanggal, nama, role, dan pertanian" value="<?= htmlspecialchars($searchActiveFarmer) ?>">
                <button type="submit" class="btn btn-success">Cari</button>
            </form>

            <div class="table-responsive table-workers">
                <table class="table align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Tanggal lahir</th>
                        <th>Role</th>
                        <th>Upah/hari</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            echo $showDataFarmer;
                        ?>
                    </tbody>
                </table>
            </div>
            <?php pagination($totalPagesFarmer, $page1,$totalPagesActiveFarmer, $page2,$searchFarmer,$searchActiveFarmer, "1");?>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>