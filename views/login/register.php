<?php
    include_once("../../includes/conn.php");
    if (isLoggedIn()) {
        header("Location: ../home/home.php");
        exit();
    }

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $full_name = $_POST['full_name'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $errors = array();

        if(empty($username)) $errors[] = "Username tidak boleh kosong";
        if(empty($email)) $errors[] = "Email tidak boleh kosong";
        if(empty($full_name)) $errors[] = "Nama lengkap tidak boleh kosong";
        if(empty($password)) $errors[] = "Password tidak boleh kosong";
        if(empty($confirm_password)) $errors[] = "Password tidak boleh kosong";

        $check_query = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt_check = $conn->prepare($check_query);
        $stmt_check->bind_param('ss',$username, $email);
        $stmt_check->execute();
        if($stmt_check->get_result()->num_rows > 0){
            $errors[] = "Username atau email sudah terdaftar";
        }

        if ($password !== $confirm_password) {
            $errors[] = "Konfirmasi password tidak cocok";
        }
        
        if(empty($errors)){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO users (username, email, full_name, password) 
                            VALUES (?,?,?,?)";
            $stmt_insert = $conn->prepare($insert_query);
            $stmt_insert->bind_param('ssss', $username, $email, $full_name, $hashed_password);
            if($stmt_insert->execute()){
                $success ="Registrasi berhasil! silahkan login.";
            } else {
                $errors[] = "Error: ".mysqli_error($conn);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Manrope:wght@200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/login.css?v=1.2">


    <title>Sign Up | Kelola Tani</title>
</head>
<body>
    <div class="wrapper">
        <div class="container main-login">
            <div class="row">
                <?php if (isset($errors) && !empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if (isset($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>


                <div class="col-md-6 side-image-login side-image-register">
                    <!-- image -->
                    <img src="" alt="" class="img-login">
                    <div class="text">
                        <p>Kelola Tani: <br>Your solution for seamless farm administration</p>
                    </div>
                </div>
                <div class="col-md-6 right">
                    <div class="input-box">
                        <header>Sign Up Account</header>
                        <form action="register.php" method="post">
                            <div class="input-field">
                                <input type="text" name="username" class="input" id="username" required autocomplete="off">
                                <label for="username" class="username">Username</label>
                            </div>
                            <div class="input-field">
                                <input type="text" name="full_name" class="input" id="full_name" required autocomplete="off">
                                <label for="full_name" class="full_name">full name</label>
                            </div>
                            <div class="input-field">
                                <input type="email" name="email" class="input" id="email" required autocomplete="off">
                                <label for="email" class="email">Email</label>
                            </div>
                            <div class="input-field">
                                <input type="password" name="password" class="input" id="password" required>
                                <label for="password" class="password">Password</label>
                            </div>
                            <div class="input-field">
                                <input type="password" name="confirm_password" class="input" id="confirm_password" required>
                                <label for="confirm_password" class="confirm_password">Konfirmasi Password</label>
                            </div>
                            <div class="input-field">
                                <input type="submit" class="submit" name="submit" value="Sign Up">
                            </div>
                            <div class="signup">
                                <span>Already have an account? <a href="login.php">Sign In here</a> </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>