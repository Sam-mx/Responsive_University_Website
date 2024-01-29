<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Portal Login | University of Sam</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/uos-icon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />

    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro:400,900|Source+Sans+Pro:300,900&display=swap" rel="stylesheet" />

    <!-- Icons-->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />

    <link rel="stylesheet" href="../assets/css/student.css" />
</head>

<body>

    <!-- Php Login -->
    <?php
    if (isset($_POST["submit"])) {
        if (!empty($_POST['email']) && !empty($_POST['pass'])) {
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $con = mysqli_connect('localhost', 'root', '', 'universityofsam');
            $query = mysqli_query($con, "SELECT * FROM student WHERE email='" . $email . "' AND password='" . $pass . "'");
            $numrows = mysqli_num_rows($query);
            if ($numrows != 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $dbemail = $row['email'];
                    $dbpassword = $row['password'];
                    $name = $row['name'];
                    $Studentid = $row['student_id'];
                }

                if ($email == $dbemail && $pass == $dbpassword) {
                    session_start();
                    $_SESSION['sess_user'] = $Studentid;
                    header("Location: ./student-portal/student_portal.php");
                }
            } else {
                $_SESSION["errorMessage"] = "Invalid Credentials";
            }
        }
    } ?>

    <div class="login">
        <img src="../assets/img/student-portal.png" alt="login image" class="login__img" />

        <form action="" class="login__form" method="POST" id="login-form">
            <div class="Logo__img">
                <a href="../home.html">
                    <img src="../assets/img/Logo.png" alt="" />
                </a>
            </div>
            <h1 class="login__title mt-3 p-3">Student-Portal Login</h1>



            <div class="login__content">
                <div class="login__box">
                    <i class="ri-user-3-line login__icon"></i>

                    <div class="login__box-input">
                        <input type="email" required class="login__input" id="login-email" placeholder=" " name="email" />
                        <label for="login-email" class="login__label">Email</label>
                    </div>
                </div>

                <div class="login__box">
                    <i class="ri-lock-2-line login__icon"></i>

                    <div class="login__box-input">
                        <input type="password" required class="login__input" id="login-pass" placeholder=" " name="pass" />
                        <label for="login-pass" class="login__label">Password</label>
                        <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                    </div>
                </div>
            </div>

            <div class="login__check">
                <div class="login__check-group">
                    <input type="checkbox" class="login__check-input" id="login-check" />
                    <label for="login-check" class="login__check-label">Remember me</label>
                </div>

                <a href="#" class="login__forgot">Forgot Password?</a>
            </div>

            <!-- Validation Message -->
            <?php
            if (isset($_SESSION["errorMessage"])) {
            ?>
                <div class="error-message text-center text-danger p-3 mb-3" id="error"><?php echo $_SESSION["errorMessage"]; ?></div>
            <?php
                unset($_SESSION["errorMessage"]);
            }
            ?>

            <button type="submit" class="login__button" name="submit" id="submit">Login</button>

            <p class="login__register">Are you one of us? Please log in</p>
        </form>
    </div>

    <script src="../assets/js/staff.js"></script>
</body>

</html>