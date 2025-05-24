<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tani</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="shadow-lg ">
        <nav class="navbar bg-body-tertiary fixed-top z-1 border-bottom border-dark-subtle border-bottom-3">
            <div class="container-fluid d-flex justify-content-between">
                <a class="navbar-brand" href="#">Kelola tani</a>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active link-opacity-100" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-opacity-100" href="#">Human Resources</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-opacity-100" href="#">Farm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-opacity-100">Menu</a>
                    </li>
                </ul>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle btn-login" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg> Login
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Sign Up</a></li>
                        <li><a class="dropdown-item" href="#">Sign In</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="wrapper  pt-6 d-flex flex-row">
        <aside class="sidebar bg-body-tertiary pt-6 vh-100 fixed-top overflow-y-scroll z-0">
            <div class="ms-4 mt-4">
                <p><a class="link-opacity-10-hover link-color" href="#">Summariez</a></p>
                <p><a class="link-opacity-10-hover link-color" href="#">Highlight</a></p>
            </div>
        </aside>

        <main class="ms-250p">
            <div class="informasi"></div>
        </main>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>