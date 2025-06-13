<?php
    include_once("../../includes/conn.php");
    if (isLoggedIn()) {
        header("Location: ../home/home.php");
        exit();
    }

    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                header("Location: ../home/home.php");
                exit();
            } else {
                $error = "Username atau password salah!";
            }
        } else {
            $error = "Username atau password salah!";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <title>Sign In | Kelola Tani</title>
</head>
<body>
    <div class="wrapper">
        <div class="container main-login">
            <div class="row">
                <div class="col-md-6 side-image-login pt-3">
                    <!-- image -->
                    <a href="../../index.php"><i class="bi bi-arrow-left-square-fill ms-3 fs-3 back"></i></a>
                    <img src="" alt="" class="img-login">
                    <div class="text">
                        <p>Kelola Tani: <br>Your solution for seamless farm administration</p>
                    </div>
                </div>
                <div class="col-md-6 right">
                    <div class="input-box">
                        <header>Sign In Account</header>
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger mt-0"><?php echo $error; ?></div>
                            <?php endif; ?>
                        <form action="login.php" method="post">
                            <div class="input-field">
                                <input type="text" name="username" class="input" id="username" required autocomplete="off">
                                <label for="username" class="username">Email atau Username</label>
                            </div>
                            <div class="input-field">
                                <input type="password" name="password" class="input" id="password"  required>
                                <label for="password" class="password">Password</label>
                            </div>  
                            <div class="input-field">
                                <button type="submit" name="submit" class="submit">Sign In</button>
                            </div>
                            <div class="signup">
                                <span>Doesn't have an account? <a href="register.php">Sign Up here</a> </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>