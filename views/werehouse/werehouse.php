<!-- Halaman home -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <!-- Navbar -->
    <?php require_once '../../includes/navbar.php';?>
    
    <main class="main container d-flex flex-column gap-4 mb-4">
        <h1>Werehouse</h1>
        <section class="container_sect ringkasan_data p-4">
            <h2 class="fs-4">Summary</h2>
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
            <h2 class="fs-4">Storage</h2>   
        </section>

        <section class="container_sect p-4">
            <h2 class="fs-4">Stock flow</h2>
            
        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>