<?php
    require_once "../../includes/conn.php";
    include_once "../../includes/showData.php";
    requireLogin(); 
    $id_user = $_SESSION['id_user'];
    $show = new ShowData($conn, $_SESSION['id_user']); 


    // Tanaman
    if(isset($_POST['submit'])){
        $nameCrop = $_POST['nameCrop'];
        
        $errorsCrop = array();

        if(empty($nameCrop)) $errorsCrop[] = "Nama tanaman tidak boleh kosong.";

        if(empty($errorsCrop)){
            $queryCrop = "CALL tambah_tanaman(?,?)";
            $stmtCrop = $conn->prepare($queryCrop);
            $stmtCrop->bind_param('si',$nameCrop, $id_user);
            $stmtCrop->execute();
            $stmtCrop->close();
        }
    }

    $feedbackMessage ='';
    
    // Feedback
    if(isset($_POST['fbSubmit'])){
        $fbCategory = $_POST['fbCategory'];
        $fbTitle = $_POST['fbTitle'];
        $fbMessage = $_POST['fbMessage'];
        
        $errorsFeedback = array();
        
        if(empty($fbCategory)) $errorsFeedback[] = "Kategori tidak boleh kosong.";
        if(empty($fbTitle)) $errorsFeedback[] = "Judul tidak boleh kosong.";
        
        if(empty($errorsFeedback)){
            $queryFeedback = "INSERT INTO feedback (id_user, kategori_feedback, title_feedback, detail_feedback) VALUES (?,?,?,?)";
            $stmtFeedback = $conn->prepare($queryFeedback);
            $stmtFeedback->bind_param('isss', $id_user, $fbCategory, $fbTitle, $fbMessage);
            if($stmtFeedback->execute()){
                $feedbackMessage = "Feedback telah terkirim, terima kasih atas dukungan Anda";
            } else {
                $feedbackMessage = "Feedback gagal terkirim, mohon coba lagi nanti";
            }
            $stmtFeedback->close();
        }
    }
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <title>Settings | Kelola Tani</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/settings.css?v=1.2">
    <link rel="stylesheet" href="../../assets/css/style.css?v=1.2">
</head>
<body>
    <?php
        if($feedbackMessage){
            echo "<script>alert(".json_encode($feedbackMessage).")</script>";
        } else {
            
        }
    ?>
    <!-- Navbar -->
    <?php require_once '../../includes/navbar.php';?>
    <div class="wrapper">
        <div class="container main main-settings">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <!-- Sidebar -->
                    <div class="col-md-3 col-lg-2">
                        <div class="sidebar">
                            <ul class="sidebar-menu">
                                <li class="fs-3">Settings</li>
                                <li><a href="#" data-page="tanaman" selected>Tanaman</a></li>
                                <li><a href="#" data-page="feedback">Feedback</a></li>
                                <li><a href="logout.php" class="logout-link" onclick="return confirm('Are you sure want to log out?')">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Main Content -->
                    <div class="col-md-9 col-lg-10">
                        <div class="main-content">
                            <div class="content-area">
                                <!-- Content goes here -->
                                <p class="text-muted"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // AJAX function to load content
            function loadContent(page) {
                $('.content-area').html('<div class="text-center"><div class="spinner-border text-success" role="status"><span class="visually-hidden">Loading...</span></div></div>');
                
                $.ajax({
                    url: page + '.php', // Adjust path as needed
                    type: 'GET',
                    timeout: 10000,
                    success: function(data) {
                        $('.content-area').html(data);
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = '';
                        if (status === 'timeout') {
                            errorMessage = 'Request timeout. Please try again.';
                        } else if (xhr.status === 404) {
                            errorMessage = 'Page not found.';
                        } else {
                            errorMessage = 'Error loading content: ' + error;
                        }
                        $('.content-area').html(
                            '<div class="alert alert-danger" role="alert">' +
                            '<h4 class="alert-heading">Oops!</h4>' +
                            '<p>' + errorMessage + '</p>' +
                            '<button class="btn btn-outline-danger" onclick="location.reload()">Refresh Page</button>' +
                            '</div>'
                        );
                    }
                });
            }

            // Handle sidebar menu clicks
            $('.sidebar-menu a:not(.logout-link)').click(function(e) {
                e.preventDefault();
                
                // Remove active class from all menu items
                $('.sidebar-menu a').removeClass('active');
                
                // Add active class to clicked item
                $(this).addClass('active');
                
                // Get page name from href or data attribute
                let page = $(this).data('page');
                
                // Update content header
                let headerText = $(this).text();
                if (headerText !== 'Settings') {
                    $('.content-header').text(headerText);
                }
                
                // Load content via AJAX
                loadContent(page);
                
                // Update URL without page refresh (optional)
                if (history.pushState) {
                    history.pushState(null, null, '?page=' + page);
                }
            });

            // Handle browser back/forward buttons
            window.addEventListener('popstate', function(e) {
                let urlParams = new URLSearchParams(window.location.search);
                let page = urlParams.get('page') || 'tanaman';
                
                // Update active menu
                $('.sidebar-menu a').removeClass('active');
                $('.sidebar-menu a[data-page="' + page + '"]').addClass('active');
                
                loadContent(page);
            });

            // Load initial content based on URL parameter
            $(window).on('load', function() {
                let urlParams = new URLSearchParams(window.location.search);
                let page = urlParams.get('page') || 'tanaman';
                
                $('.sidebar-menu a[data-page="' + page + '"]').addClass('active');
                loadContent(page);
            });

            // Auto-refresh token or session (optional)
            setInterval(function() {
                $.ajax({
                    url: 'check_session.php',
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 'expired') {
                            alert('Your session has expired. Please login again.');
                            window.location.href = 'login.php';
                        }
                    }
                });
            }, 300000); // Check every 5 minutes
        });

        // Utility function for showing notifications
        function showNotification(message, type = 'success') {
            let alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            let notification = `
                <div class="alert ${alertClass} alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert" style="z-index: 9999;">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            $('body').append(notification);
            
            // Auto remove after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut();
            }, 5000);
        }
    </script>
</body>
</html>