

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
    <link rel="stylesheet" href="../../assets/css/home.css?v=1.2">
</head>
<body>
    <!-- Navbar -->
    <?php require_once '../../includes/navbar.php';?>

    <main class="main container d-flex flex-column gap-4 mb-4">
        <h1 class="fw-bold text-primary-green">Home</h1>
       <section class="container-fluid p-3">
            <div class="card">
                <!-- Header hijau -->
                <div class="card-header bg-primary-green text-white rounded-top">
                    <h2 class="fw-bold m-0">Summary</h2>
                </div>
                
                <!-- Body konten -->
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <h3 class="fs-5 fw-bold text-primary-green">Human Resources</h3>
                            <p>Workers: 0</p>
                            <p>Average Salary: 0</p>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <h3 class="fs-5 fw-bold text-primary-green">Farm</h3>
                            <p>Owned land: 0</p>
                            <p>Land area: 0</p>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <h3 class="fs-5 fw-bold text-primary-green">Werehouse</h3>
                            <p>Workers: 0</p>
                            <p>Average Salary: 0</p>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <h3 class="fs-5 fw-bold text-primary-green">Farm</h3>
                            <p>Crop variety: 0</p>
                            <p>Current stock: 0</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!-- KARTU -->
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <a href="../human_resources/hr.php">
                    <div class="card card-HR">
                    <img src="../../assets/img/human_resources.webp" class="card-img-top img-sizing" alt="https://www.pexels.com/photo/a-man-in-yellow-long-sleeves-cutting-grass-12199597/">
                        <div class="card-body">
                            <h5 class="card-title">Human Resources</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="../farm/farm.php">
                    <div class="card card-FR">
                    <img src="../../assets/img/farm.webp" class="card-img-top img-sizing" alt="https://www.pexels.com/photo/aerial-shot-of-green-milling-tractor-1595108/">
                        <div class="card-body">
                            <h5 class="card-title">farm</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="../werehouse/werehouse.php">
                    <div class="card card-WH">
                    <img src="../../assets/img/werehouse.webp" class="card-img-top img-sizing" alt="https://www.pexels.com/photo/red-barn-235725/">
                        <div class="card-body">
                            <h5 class="card-title">Werehouse</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>