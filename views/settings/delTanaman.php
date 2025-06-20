<?php
require_once "../../includes/conn.php";
requireLogin();

$id_user = $_SESSION['id_user'];
$error_message = null; 
$redirect_to = "settings.php?page=tanaman"; 

if (!isset($_GET['id'])) {
    header("Location: " . $redirect_to);
    exit();
}

$id_crop = $_GET['id'];

try {
    $query = 'CALL hapus_tanaman(?,?)';
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param('ii', $id_crop, $id_user);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: " . $redirect_to . "&status=success&message=" . urlencode("Tanaman berhasil dihapus."));
            exit();
        } else {
            $error_message = "Tanaman tidak ditemukan atau Anda tidak memiliki izin untuk menghapusnya.";
        }
        $stmt->close();
    } else {
        $error_message = "Terjadi kesalahan sistem saat menyiapkan operasi.";
    }

} catch (mysqli_sql_exception $e) {
    if (strpos($e->getMessage(), 'foreign key constraint fails') !== false) {
        $error_message = "Tidak dapat menghapus tanaman ini karena masih digunakan dalam data penanaman. Harap hapus data penanaman terkait terlebih dahulu.";
    } else {
        $error_message = "Terjadi kesalahan database: " . $e->getMessage();
    }
} catch (Exception $e) {
    $error_message = "Terjadi kesalahan umum: " . $e->getMessage();
}

$js_error_message = $error_message ? json_encode($error_message) : null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus</title>
</head>
<body>
    <?php if ($js_error_message): ?>
    <script>
        var userConfirmed = confirm(<?php echo $js_error_message; ?> + "\n\nKlik OK untuk kembali.");
        window.location.href = '<?php echo $redirect_to; ?>';
    </script>
    <?php endif; ?>
    </body>
</html>