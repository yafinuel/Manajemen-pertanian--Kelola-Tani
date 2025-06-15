<?php
    require_once "../../includes/conn.php";
    include_once "../../includes/showData.php";
    requireLogin(); 
    $id_user = $_SESSION['id_user']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
</head>
<body>
    <form id="feedbackForm" action="settings.php?page=feedback" method="post">
        <div class="mb-3">
            <label class="form-label">Kategori Feedback<span class="text-danger">*</span></label>
            <select class="form-select" name="fbCategory" required>
                <option value="">Pilih kategori...</option>
                <option value="bug">Laporan Bug</option>
                <option value="feature">Saran Fitur</option>
                <option value="ui">Antarmuka</option>
                <option value="performance">Performa</option>
                <option value="other">Lainnya</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Feedback<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="fbTitle" placeholder="Ringkas feedback Anda..." required>
            <small class="text-muted">Maksimal 20 karakter</small>
        </div>

        <div class="mb-4">
            <label class="form-label">Detail Feedback</label>
            <textarea class="form-control" name="fbMessage" rows="5" placeholder="Tulis deskripsi feedback Anda disini..."></textarea>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-submit" name="fbSubmit">
                <i class="fas fa-paper-plane me-2"></i>Kirim Feedback
            </button>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>