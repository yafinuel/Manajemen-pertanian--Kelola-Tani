<?php
    require_once "../../includes/conn.php";
    include_once "../../includes/showData.php";
    requireLogin();

    $show = new ShowData($conn, $_SESSION['id_user']); 
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
    
    <title>Farms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body>
    <!-- Navbar -->
    <?php require_once '../../includes/navbar.php';?>
    
    <main class="main container d-flex flex-column gap-4 mb-4">
        <h1 class="fw-bold text-primary-green">Farm</h1>
        <section class="container_sect ringkasan_data p-4">
            <h2 class="fs-4 fw-bold text-primary-green">Summary</h2>
                <ul class="list-unstyled">
                    <li class="d-flex">
                        <div class="label pe-2" style="min-width: 120px;">Owned land</div>
                        <div class="result">:</div>
                    </li>
                    <li class="d-flex">
                        <div class="label pe-2" style="min-width: 120px;">Land area</div>
                        <div class="result">:</div>
                    </li>
                </ul>
        </section>

        <section class="container_sect p-4 d-flex flex-column gap-3">
            <div class="d-flex justify-content-between">
                <h2 class="fs-4 fw-bold text-primary-green">Planted</h2>
                <button class='btn btn-primary-green text-white fw-bold border-0' >Add Farm Planted</button>
            </div>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Lahan Pertanian</th>
                        <th scope="col">Komoditas lahan</th>
                        <th scope="col">Jumlah pekerja</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>2025/05/28</td>
                        <td>Pertanian 1</td>
                        <td>Padi</td>
                        <td><a href="">3 Orang</a></td>
                        <td><a href="">edit</a> | <a href="" class="text-danger">delete</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="container_sect p-4 d-flex flex-column gap-3">
            <div class="d-flex justify-content-between">
                <h2 class="fs-4 fw-bold text-primary-green">Farm list</h2>
                <button class='btn btn-primary-green text-white fw-bold border-0' >Add Farm</button>
            </div>
            <!-- Ini adalah list containernya untuk loop db nanti -->
            <div class="list-group gap-2">
                <?php $show->showDataFarms();?>                
            </div>
        </section>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>