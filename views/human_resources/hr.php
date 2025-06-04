<?php
    require_once "../../includes/conn.php";
    include_once "../../includes/functionFarmers.php";

    $show = new showFarmer($conn); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Human Resources</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body>
    <!-- Navbar -->
    <?php require_once '../../includes/navbar.php';?>
    
    <main class="main container d-flex flex-column gap-4 mb-4">
        <h1 class="fw-bold text-primary-green">Human Resources</h1>
        <section class="container_sect ringkasan_data p-4">
            <h2 class="fs-4 fw-bold text-primary-green">Summary</h2>
                <ul class="list-unstyled">
                    <li class="d-flex">
                        <div class="label pe-2" style="min-width: 120px;">Workers</div>
                        <div class="result">:</div>
                    </li>
                    <li class="d-flex">
                        <div class="label pe-2" style="min-width: 120px;">Active workers</div>
                        <div class="result">:</div>
                    </li>
                </ul>
        </section>

        <section class="container_sect p-4 d-flex flex-column gap-3">
            <div class="d-flex justify-content-between">
                <h2 class="fs-4 fw-bold text-primary-green">Active Workers</h2>
                <button class='btn btn-primary-green text-white fw-bold border-0' >Add Active Workers</button>
            </div>
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
                        <tr>
                            <th scope="row">1</th>
                            <td>2025/05/28</td>
                            <td>Pertanian 1</td>
                            <td>Yafi</td>
                            <td>Consultant</td>
                            <td><a href="" class="text-primary">edit</a> | <a href="" class="text-danger">delete</a></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>2025/05/28</td>
                            <td>Pertanian 2</td>
                            <td>Rudi</td>
                            <td>Petani</td>
                            <td><a href="" class="text-primary">edit</a> | <a href="" class="text-danger">delete</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="container_sect p-4 d-flex flex-column gap-3">
            <div class="d-flex justify-content-between">
                <h2 class="fs-4 fw-bold text-primary-green">Workers</h2>
                <a href="addFarmer.php">
                    <button class='btn btn-primary-green text-white fw-bold border-0' >Add workers</button>
                </a>
            </div>

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
                            $show->showDataFarmer();
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>