<!-- Halaman home -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/home.css">
</head>
<body>
    <!-- Navbar -->
    <?php require_once '../../includes/navbar.php';?>

    <main class="main container d-flex flex-column gap-4 mb-4">
        <h1>Home</h1>
        <section class="container_sect ringkasan_data p-4">
            <h2 class="fs-4">Summary</h2>
            <div class="row mt-5"> <!-- Gunakan row -->
                <!-- Kolom Worker -->
                <div class="col-md-4 mb-4">
                    <ul class="list-unstyled">
                        <li><h6>Worker</h6></li>
                        <li class="d-flex">
                            <div class="label pe-2" style="min-width: 120px;">Workers</div>
                            <div class="result">:</div>
                        </li>
                        <li class="d-flex">
                            <div class="label pe-2" style="min-width: 120px;">Active workers</div>
                            <div class="result">:</div>
                        </li>
                    </ul>
                </div>
                
                <!-- Kolom Farm -->
                <div class="col-md-4 mb-4">
                    <ul class="list-unstyled">
                        <li><h6>Farm</h6></li>
                        <li class="d-flex">
                            <div class="label pe-2" style="min-width: 140px;">Owned land</div>
                            <div class="result">:</div>
                        </li>
                        <li class="d-flex">
                            <div class="label pe-2" style="min-width: 140px;">Land area</div>
                            <div class="result">:</div>
                        </li>
                    </ul>
                </div>
                
                <!-- Kolom Warehouse -->
                <div class="col-md-4 mb-4">
                    <ul class="list-unstyled">
                        <li><h6>Warehouse</h6></li>
                        <li class="d-flex">
                            <div class="label pe-2" style="min-width: 140px;">Crop Variety</div>
                            <div class="result">:</div>
                        </li>
                        <li class="d-flex">
                            <div class="label pe-2" style="min-width: 140px;">Current stock</div>
                            <div class="result">:</div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- KARTU -->
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card card-HR">
                <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Human Resources</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-FR">
                <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">farm</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-WH">
                <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Werehouse</h5>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>