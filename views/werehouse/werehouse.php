<?php
    require_once "../../includes/conn.php";
    requireLogin();
    include_once "../../includes/showData.php";
    include_once "../../includes/funcPagination.php";

    $show = new ShowData($conn, $_SESSION['id_user']); 
    
    // Searching
    $searchWerehouse = isset($_GET['search1']) ? $_GET['search1'] : '';
    $searchFlowStorage = isset($_GET['search2']) ? $_GET['search2'] : '';

    // data pagination untuk farmer
    $dataWerehouse = $show->showDataWerehouse($searchWerehouse);
    $page1 = $dataWerehouse["currentPage"];
    $totalPagesWerehouse = $dataWerehouse["totalPages"];
    $showDataWerehouse = $dataWerehouse["textHTML"];

    $dataFlowStorage = $show->showDataStock($searchFlowStorage);
    $page2 = $dataFlowStorage["currentPage"];
    $totalPagesFlowStorage = $dataFlowStorage["totalPages"];
    $showDataFlowStorage = $dataFlowStorage["textHTML"];
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
    
    <title>Werehouse | Kelola Tani</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body>
    <!-- Navbar -->
    <?php require_once '../../includes/navbar.php';?>
    
    <main class="main container d-flex flex-column gap-4 mb-4">
        <h1 class="fw-bold text-primary-green">Werehouse</h1>
            
        <section class="container_sect p-4">
            <div class="d-flex justify-content-between  mb-4 mt-3">
                <h2 class="fs-4 fw-bold text-primary-green">Pencatatan Gudang</h2>
                <a href="addStock.php"><button class='btn btn-primary-green text-white fw-bold border-0 mb-3'>Tambah data</button></a>
            </div>
            <form method="get" class="mb-3 d-flex gap-2">
                <input type="text" name="search2" class="form-control" placeholder="Cari berdasarkan tanggal dan nama tanaman" value="<?= htmlspecialchars($searchFlowStorage) ?>">
                <input type="hidden" name="search1" class="form-control" placeholder="Cari nama atau role" value="<?= htmlspecialchars($searchWerehouse) ?>">
                <button type="submit" class="btn btn-success">Cari</button>
            </form>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Tanaman</th>
                        <th scope="col">Masuk</th>
                        <th scope="col">Keluar</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $showDataFlowStorage;?>
                    </tbody>
                </table>
            </div>
             <?php pagination($totalPagesWerehouse, $page1,$totalPagesFlowStorage, $page2,$searchWerehouse,$searchFlowStorage, "2");?>
        </section>

        <section class="container_sect p-4">
            <div class="d-flex justify-content-between mb-4 mt-3">
                <h2 class="fs-4 fw-bold text-primary-green">Gudang</h2>
            </div>            
            <form method="get" class="mb-3 d-flex gap-2">
                <input type="text" name="search1" class="form-control" placeholder="Cari nama atau role" value="<?= htmlspecialchars($searchWerehouse) ?>">
                <input type="hidden" name="search2" class="form-control" placeholder="Cari berdasarkan nama tanaman" value="<?= htmlspecialchars($searchFlowStorage) ?>">
                <button type="submit" class="btn btn-success">Cari</button>
            </form>
            <div class="row bg-light p-3 mb-3 rounded justify-content-between  pe-5">
                <div class="col-1 text-center">
                    <strong>No</strong>
                </div>
                <div class="col-1">
                    <strong>Tanaman</strong>
                </div>
                <div class="col-1 text-center">
                    <strong>Jumlah</strong>
                </div>
            </div>  
            <?php echo $showDataWerehouse; ?>
             <?php pagination($totalPagesWerehouse, $page1,$totalPagesFlowStorage, $page2,$searchWerehouse,$searchFlowStorage, "1");?>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>