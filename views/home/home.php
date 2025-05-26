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
    <?php include '../../includes/navbar.php';?>

    <main class="main container">
        <h1>Home</h1>
        <section class="container_sect ringkasan_data p-4">
    <h2>Ringkasan</h2>
    <div class="row mt-5"> <!-- Gunakan row -->
        <!-- Kolom Worker -->
        <div class="col-md-4 mb-4">
            <ul class="list-unstyled">
                <li><h6>Worker</h6></li>
                <li class="d-flex">
                    <div class="label pe-2" style="min-width: 120px;">Total pekerja</div>
                    <div class="result">:</div>
                </li>
                <li class="d-flex">
                    <div class="label pe-2" style="min-width: 120px;">Total gaji</div>
                    <div class="result">:</div>
                </li>
            </ul>
        </div>
        
        <!-- Kolom Farm -->
        <div class="col-md-4 mb-4">
            <ul class="list-unstyled">
                <li><h6>Farm</h6></li>
                <li class="d-flex">
                    <div class="label pe-2" style="min-width: 140px;">Tanah yang dimiliki</div>
                    <div class="result">:</div>
                </li>
                <li class="d-flex">
                    <div class="label pe-2" style="min-width: 140px;">Luas tanah</div>
                    <div class="result">:</div>
                </li>
            </ul>
        </div>
        
        <!-- Kolom Warehouse -->
        <div class="col-md-4 mb-4">
            <ul class="list-unstyled">
                <li><h6>Warehouse</h6></li>
                <li class="d-flex">
                    <div class="label pe-2" style="min-width: 140px;">Jumlah komoditas</div>
                    <div class="result">:</div>
                </li>
                <li class="d-flex">
                    <div class="label pe-2" style="min-width: 140px;">Total berat</div>
                    <div class="result">:</div>
                </li>
            </ul>
        </div>

    </div>
</section>

<!-- KARTU -->

<section id="pintasan" class="container mt-4">
    <div class="row g-4 justify-content-center">
        <!-- Kartu HR -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 card-HR">
                <div class="card-body">
                    <h5 class="card-title">Human Resources</h5>
                    <div class="card-text">
                        <div class="d-flex mb-2">
                            <div class="label" style="min-width: 120px;">Total pekerja</div>
                            <div class="result">:</div>
                        </div>
                        <div class="d-flex">
                            <div class="label" style="min-width: 120px;">Total gaji</div>
                            <div class="result">:</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Kartu Farm -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 card-FR">
                <div class="card-body">
                    <h5 class="card-title">Farm</h5>
                    <div class="card-text">
                        <div class="d-flex mb-2">
                            <div class="label" style="min-width: 120px;">Owned</div>
                            <div class="result">:</div>
                        </div>
                        <div class="d-flex">
                            <div class="label" style="min-width: 120px;">Surface area</div>
                            <div class="result">:</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Kartu Warehouse -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card h-100 card-WH ">
                <div class="card-body">
                    <h5 class="card-title">Werehouse</h5>
                    <div class="card-text">
                        <div class="d-flex mb-2">
                            <div class="label" style="min-width: 120px;">Comodity Variate</div>
                            <div class="result">:</div>
                        </div>
                        <div class="d-flex">
                            <div class="label" style="min-width: 120px;">Total Comodity</div>
                            <div class="result">:</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>