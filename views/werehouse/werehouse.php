<!-- Halaman home -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body>
    <!-- Navbar -->
    <?php require_once '../../includes/navbar.php';?>
    
    <main class="main container d-flex flex-column gap-4 mb-4">
        <h1 class="fw-bold text-primary-green">Werehouse</h1>
        <section class="container_sect ringkasan_data p-4">
            <h2 class="fs-4 fw-bold text-primary-green">Summary</h2>
            <ul class="list-unstyled">
                    <li class="d-flex">
                        <div class="label pe-2" style="min-width: 120px;">Crop variety</div>
                        <div class="result">:</div>
                    </li>
                    <li class="d-flex">
                        <div class="label pe-2" style="min-width: 120px;">Current stock</div>
                        <div class="result">:</div>
                    </li>
                </ul>
            </section>
            
            <section class="container_sect p-4">
                <div class="d-flex justify-content-between">
                    <h2 class="fs-4 fw-bold text-primary-green">Stock flow</h2>
                    <button class='btn btn-primary-green text-white fw-bold border-0' >Add flow</button>
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

        <section class="container_sect p-4">
            <div class="d-flex justify-content-between">
                <h2 class="fs-4 fw-bold text-primary-green">Storage</h2>
                <button class='btn btn-primary-green text-white fw-bold border-0' >Add item</button>
            </div>
            <div class="row bg-light p-3 mb-3 rounded">
                <div class="col-1 text-center">
                    <strong>#</strong>
                </div>
                <div class="col-4">
                    <strong>Nama Item</strong>
                </div>
                <div class="col-3 text-center">
                    <strong>Jumlah</strong>
                </div>
                <div class="col-4 text-center">
                    <strong>Action</strong>
                </div>
            </div>
        
        <div class="row border rounded p-3 mb-2">
            <div class="col-1 text-center">
                <span class="badge bg-secondary">1</span>
            </div>
            <div class="col-4">
                <h6 class="mb-0">Padi</h6>
            </div>
            <div class="col-3 text-center">
                <p>200kg</p>
            </div>
            <div class="col-4 text-center">
                <a href="#" class="text-primary me-2">edit</a> • 
                <a href="#" class="text-danger ms-2">delete</a>
            </div>
        </div>
        
        <div class="row border rounded p-3 mb-2">
            <div class="col-1 text-center">
                <span class="badge bg-secondary">2</span>
            </div>
            <div class="col-4">
                <h6 class="mb-0">Jagung</h6>
            </div>
            <div class="col-3 text-center">
                <p>100kg</p>
            </div>
            <div class="col-4 text-center">
                <a href="#" class="text-primary me-2">edit</a> • 
                <a href="#" class="text-danger ms-2">delete</a>
            </div>
        </div>
    </section>
    
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>