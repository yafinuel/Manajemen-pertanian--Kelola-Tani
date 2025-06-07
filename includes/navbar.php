<?php
    function getActivePage() {
    return basename($_SERVER['PHP_SELF'], '.php');
}

function isActivePage($page_name) {
    return getActivePage() === $page_name;
}

function getAriaCurrentPage($page_name) {
    return isActivePage($page_name) ? 'aria-current="page"' : '';
}

function getActiveClass($page_name) {
    return isActivePage($page_name) ? 'active' : '';
}

?>
<nav class="navbar navbar-expand-lg bg-primary-green fixed-top z-1">
        <div class="container-fluid">
            <a class="navbar-brand me-auto fw-bold fs-3 text-white" href="#">Kelola Tani</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto d-flex gap-2">
                <li class="nav-item">
                <a class="nav-link text-white <?php echo getActiveClass('home'); ?>" <?php echo getAriaCurrentPage('home'); ?>href="../home/home.php">Dashboard</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white <?php echo getActiveClass('hr'); ?>" <?php echo getAriaCurrentPage('hr'); ?> href="../human_resources/hr.php">Human Resources</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white <?php echo getActiveClass('farm'); ?>" <?php echo getAriaCurrentPage('farm'); ?> href="../farm/farm.php">Farm</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white <?php echo getActiveClass('werehouse'); ?>" <?php echo getAriaCurrentPage('werehouse'); ?>  href="../werehouse/werehouse.php">Werehouse</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white <?php echo getActiveClass('settings'); ?>" href="../settings/settings.php">Settings</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>