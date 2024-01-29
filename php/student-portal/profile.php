<?php
session_start();


if (!isset($_SESSION["sess_user"])) {
    header("location: ../staff.php");
} else {
    include("../connection/config.php");
    $studentid = $_SESSION["sess_user"];
    $query = "SELECT * FROM student where student_id='$studentid'";
    mysqli_select_db($conn, 'universityofsam');
    $user = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($user, MYSQLI_ASSOC);

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/x-icon" href="../../assets/img/uos-icon.png" />

        <title>Student Profile | University of Sam</title>

        <!-- Custom fonts for this template-->
        <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="../../assets/css/student-portal.css" rel="stylesheet">

    </head>

    <body id="page-top">


        <?php
        include('../connection/config.php');


        $oldpass = $passwordErr = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            function input_data($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            if (empty($_POST["oldpass"])) {
                $oldpass = "Old Password is required";
            } elseif ($_POST["oldpass"] !== $row['password']) {
                $oldpass = "Your old password is incorrect!";
            }

            if (empty($_POST['newpass']) || empty($_POST['confirmPassword']) || $_POST['newpass'] !== $_POST['confirmPassword']) {
                $passwordErr = "Password should be match";
            }
        }

        if (isset($_POST['changepassword'])) {
            if ($oldpass == "" && $passwordErr  == "") {

                $updatedpass = $_POST['newpass'];

                $UpdateQuery = "UPDATE student SET password='$updatedpass' WHERE student_id='" . $row['student_id'] . "'";
                if (!mysqli_query($conn, $UpdateQuery)) {
                    echo ('Error: ' . mysqli_error($conn));
                } else {

                    echo '<script>alert("Your Password has been changed successfully!!!");</script>';
                }
                mysqli_close($conn);
            } else {
                echo '<script>alert("Your information is invalid... Please try again one more time!!!");</script>';
            }
        }

        ?>
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./student_portal.php">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <img src="../../assets/img/Logo.png" width="50px">
                    </div>
                    <div class="sidebar-brand-text mx-3">Student Portal</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="./student_portal.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Welcome</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-user-graduate"></i>
                        <span>Result</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Information</h6>
                            <a class="collapse-item" href="result.php">Details</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Utilities Collapse Menu -->


                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecourse" aria-expanded="true" aria-controls="collapsecourse">
                        <i class="fas fa-fw fa-book-open"></i>
                        <span>Courses</span>
                    </a>
                    <div id="collapsecourse" class="collapse" aria-labelledby="headingcourse" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Information</h6>
                            <a class="collapse-item" href="courses.php">Modules</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-gamepad"></i>
                        <span>Games</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Information</h6>
                            <a class="collapse-item" href="./memory.php">Memory</a>
                            <a class="collapse-item" href="./tic-tac-toe.php">Tic Tac Toe</a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">


                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

                <!-- Sidebar Message -->
                <div class="sidebar-card d-none d-lg-flex">
                    <img class="sidebar-card-illustration mb-2" src="../../assets/img/undraw_rocket.svg" alt="...">
                    <p class="text-center mb-2"><strong>UOS's Environment</strong> is foster open communication for collaboration. </p>
                    <a class="btn btn-success btn-sm">Discover exceptional student services tailored to support your academic journey and personal growth.</a>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->


                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">




                            <div class="topbar-divider d-none d-sm-block"></div>


                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $row['student_name']; ?></span>
                                    <?php
                                    $power = base64_decode($row['profile_pic']);
                                    $photo_name = $row['student_name'] . '.png';
                                    $file_path = './img/';
                                    $file = fopen($file_path . $photo_name, 'wb');
                                    fwrite($file, $power);
                                    fclose($file);
                                    echo "  <img class='img-profile rounded-circle mb-2'  src='./img/$photo_name'  alt='Profile Picture from database'>";
                                    ?>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="./profile.php">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="container">
                            <h1 class="text-center p-3 mt-3 text-primary">Profile</h1>
                        </div>

                        <div class="container bootstrap snippets bootdey">
                            <div class="panel-body inf-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <?php

                                        echo "  <img class='img-profile rounded-circle mb-2 p-3'  src='./img/$photo_name' width='350px' height='350px' alt='Photo from database'>";
                                        ?>
                                        <p class="text-warning p-3 m-3">P.S. If you can't load a photo, You have no <b>Profile Picture</b> Yet!</p>

                                    </div>

                                    <div class="col-md-6 mt-3 mb-3">
                                        <strong>Information</strong><br>
                                        <div class="table-responsive">
                                            <table class="table table-user-information">
                                                <tbody>
                                                    <?php
                                                    include("../connection/config.php");


                                                    $coursefetch = "SELECT course_name,faculty FROM courses where course_id='$row[course_id]'";
                                                    $courseresult = mysqli_query($conn, $coursefetch);
                                                    while ($course = mysqli_fetch_array($courseresult, MYSQLI_ASSOC)) {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <strong>
                                                                    <i class="fas fa-fw fa-star-of-life text-primary"></i>
                                                                    Student ID
                                                                </strong>
                                                            </td>
                                                            <td class="text-primary">
                                                                <?= $studentid; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>
                                                                    <i class="fas fa-fw fa-user text-primary"></i>
                                                                    Name
                                                                </strong>
                                                            </td>
                                                            <td class="text-primary">
                                                                <?= $row['student_name']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>
                                                                    <i class="fas fa-fw fa-calendar text-primary"></i>
                                                                    Date of Birth
                                                                </strong>
                                                            </td>
                                                            <td class="text-primary">
                                                                <?= $row['date_of_birth']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>
                                                                    <i class="fas fa-fw fa-venus-mars text-primary"></i>
                                                                    Gender
                                                                </strong>
                                                            </td>
                                                            <td class="text-primary">
                                                                <?php
                                                                if ($row['gender'] == 0) {
                                                                    echo '<i class="fas fa-fw fa-mars text-primary"></i>';
                                                                } else {
                                                                    echo '<i class="fas fa-fw fa-venus text-danger"></i>';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <strong>
                                                                    <i class="fas fa-fw fa-book-open text-primary"></i>
                                                                    Course Name
                                                                </strong>
                                                            </td>
                                                            <td class="text-primary">
                                                                <?php echo $course['course_name']; ?>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td>
                                                                <strong>
                                                                    <i class="fas fa-fw fa-university text-primary"></i>
                                                                    Faculty
                                                                </strong>
                                                            </td>
                                                            <td class="text-primary">
                                                                <?php
                                                                if ($course['faculty'] == 0) {
                                                                    echo '<b>Faculty of <span class="text-primary">Business</span></b>';
                                                                } elseif ($course['faculty'] == 1) {
                                                                    echo '<b>Faculty of <span class="text-danger">Health</span></b>';
                                                                } elseif ($course['faculty'] == 2) {
                                                                    echo '<b>Faculty of <span class="text-info">Science and Engineering</span></b>';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <strong>
                                                                    <i class="fas fa-fw fa-ribbon text-primary"></i>
                                                                    Year
                                                                </strong>
                                                            </td>
                                                            <td class="text-primary">
                                                                <?php
                                                                if ($row['year'] == 0) {
                                                                    echo '<span class="text-primary"><b>Year 1</b></span>';
                                                                } elseif ($row['year'] == 1) {
                                                                    echo '<span class="text-danger"><b>Year 2</b></span>';
                                                                } elseif ($row['year'] == 2) {
                                                                    echo '<span class="text-warning"><b>Year 3</b></span>';
                                                                } elseif ($row['year'] == 3) {
                                                                    echo '<span class="text-info"><b>Year 4</b></span>';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td>
                                                                <strong>
                                                                    <i class="fas fa-fw fa-envelope text-primary"></i>
                                                                    Email
                                                                </strong>
                                                            </td>
                                                            <td class="text-primary">
                                                                <?= $row['email']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <i class="fas fa-fw fa-phone text-primary"></i>
                                                                Phone No:
                                                                </strong>
                                                            </td>
                                                            <td class="text-primary">
                                                                <?= $row['phno']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>
                                                                    <i class="fas fa-fw fa-map text-primary"></i>
                                                                    Address </strong>
                                                            </td>
                                                            <td class="text-primary">
                                                                <?= $row['address']; ?>
                                                            </td>
                                                        </tr>

                                                    <?php }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <a data-toggle="modal" data-target="#PasswordModal" type="button" class="btn btn-lg btn-primary p-3 m-3" style="float:right">Change Password</a>
                                        <a href="edit_profile.php" type="button" class="btn btn-lg btn-primary p-3 m-3" style="float:right">Edit Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <br>
                    </div>

                    <!-- Content Row -->

                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; UOS</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->
                </div>
                <!-- End of Content Wrapper -->

            </div>
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>


        <!-- Edit Password Modal-->
        <div class="modal fade" id="PasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="exampleModalLabel">Changing your password</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" style="background:blue;color:#fff">Password Change</div>
                            <div class="card-body">
                                <form name="pass" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="password-strength form p-4">


                                    <!-- Form Group (email address)-->
                                    <div class=" mb-3">

                                        <label class="small mb-1" for="oldpass">Old Password <span class="text-danger">*</span></label>
                                        <input class="form-control" name="oldpass" type="password" value="" placeholder="Write your old password...">


                                    </div>
                                    <!-- Form Row-->
                                    <div class="mb-3">

                                        <label for="password-input">New Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input class="password-strength__input form-control" type="password" name="newpass" id="password-input" aria-describedby="passwordHelp" placeholder="Enter password" />
                                            <div class="input-group-append">
                                                <button class="password-strength__visibility btn btn-outline-secondary" type="button"><span class="password-strength__visibility-icon" data-visible="hidden"><i class="fas fa-eye-slash"></i></span><span class="password-strength__visibility-icon js-hidden" data-visible="visible"><i class="fas fa-eye"></i></span></button>
                                            </div>
                                        </div><small class="password-strength__error text-danger js-hidden">This symbol is not allowed!</small><small class="form-text text-muted mt-2" id="passwordHelp">Add 9 characters or more, lowercase letters, uppercase letters, numbers and symbols to make the password really strong!</small>
                                    </div>
                                    <div class="password-strength__bar-block progress mb-4">
                                        <div class="password-strength__bar progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>
                                    <div class="mb-3">

                                        <label class="small mb-1" for="confirmPassword">Confirm New Password <span class="text-danger">*(you need to match with new password)</span></label>
                                        <input class="form-control" name="confirmPassword" type="password" value="">
                                    </div>

                                    <!-- Form Group (birthday)-->

                            </div>

                            <!-- Save changes button-->
                            <button class="password-strength__submit btn btn-success " type="submit" name="changepassword" disabled="disabled">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select <span class="text-primary" style="font-weight: 700;">"Logout"</span> below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>




        <!-- Bootstrap core JavaScript-->
        <script src="../../assets/vendor/jquery/jquery.min.js"></script>
        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../../assets/js/staff_portal.min.js"></script>

        <!-- Page level plugins -->
        <script src="../../assets/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../../assets/js/demo/chart-area-demo.js"></script>
        <script src="../../assets/js/demo/chart-pie-demo.js"></script>
        <script src="../../assets/js/demo/chart-bar-demo.js"></script>

        <script>
            DOM = {
                passwForm: ".password-strength",
                passwErrorMsg: ".password-strength__error",
                passwInput: document.querySelector(".password-strength__input"),
                passwVisibilityBtn: ".password-strength__visibility",
                passwVisibility_icon: ".password-strength__visibility-icon",
                strengthBar: document.querySelector(".password-strength__bar"),
                submitBtn: document.querySelector(".password-strength__submit")
            };

            //*** HELPERS

            //need to append classname with '.' symbol
            const findParentNode = (elem, parentClass) => {
                parentClass = parentClass.slice(1, parentClass.length);

                while (true) {
                    if (!elem.classList.contains(parentClass)) {
                        elem = elem.parentNode;
                    } else {
                        return elem;
                    }
                }
            };

            //*** MAIN CODE

            const getPasswordVal = (input) => {
                return input.value;
            };

            const testPasswRegexp = (passw, regexp) => {
                return regexp.test(passw);
            };

            const testPassw = (passw) => {
                let strength = "none";

                const moderate = /(?=.*[A-Z])(?=.*[a-z]).{5,}|(?=.*[\d])(?=.*[a-z]).{5,}|(?=.*[\d])(?=.*[A-Z])(?=.*[a-z]).{5,}/g;
                const strong = /(?=.*[A-Z])(?=.*[a-z])(?=.*[\d]).{7,}|(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:;"'<>,./?])(?=.*[a-z])(?=.*[\d]).{7,}/g;
                const extraStrong = /(?=.*[A-Z])(?=.*[a-z])(?=.*[\d])(?=.*[\!@#$%^&*()\\[\]{}\-_+=~`|:;"'<>,./?]).{9,}/g;

                if (testPasswRegexp(passw, extraStrong)) {
                    strength = "extra";
                } else if (testPasswRegexp(passw, strong)) {
                    strength = "strong";
                } else if (testPasswRegexp(passw, moderate)) {
                    strength = "moderate";
                } else if (passw.length > 0) {
                    strength = "weak";
                }

                return strength;
            };

            const testPasswError = (passw) => {
                const errorSymbols = /\s/g;

                return testPasswRegexp(passw, errorSymbols);
            };

            const setStrengthBarValue = (bar, strength) => {
                let strengthValue;

                switch (strength) {
                    case "weak":
                        strengthValue = 25;
                        bar.setAttribute("aria-valuenow", strengthValue);
                        break;

                    case "moderate":
                        strengthValue = 50;
                        bar.setAttribute("aria-valuenow", strengthValue);
                        break;

                    case "strong":
                        strengthValue = 75;
                        bar.setAttribute("aria-valuenow", strengthValue);
                        break;

                    case "extra":
                        strengthValue = 100;
                        bar.setAttribute("aria-valuenow", strengthValue);
                        break;

                    default:
                        strengthValue = 0;
                        bar.setAttribute("aria-valuenow", 0);
                }

                return strengthValue;
            };

            //also adds a text label based on styles
            const setStrengthBarStyles = (bar, strengthValue) => {
                bar.style.width = `${strengthValue}%`;

                bar.classList.remove("bg-success", "bg-info", "bg-warning");

                switch (strengthValue) {
                    case 25:
                        bar.classList.add("bg-danger");
                        bar.textContent = "Weak";
                        break;

                    case 50:
                        bar.classList.remove("bg-danger");
                        bar.classList.add("bg-warning");
                        bar.textContent = "Moderate";
                        break;

                    case 75:
                        bar.classList.remove("bg-danger");
                        bar.classList.add("bg-info");
                        bar.textContent = "Strong";
                        break;

                    case 100:
                        bar.classList.remove("bg-danger");
                        bar.classList.add("bg-success");
                        bar.textContent = "Extra Strong";
                        break;

                    default:
                        bar.classList.add("bg-danger");
                        bar.textContent = "";
                        bar.style.width = `0`;
                }
            };

            const setStrengthBar = (bar, strength) => {
                //setting value
                const strengthValue = setStrengthBarValue(bar, strength);

                //setting styles
                setStrengthBarStyles(bar, strengthValue);
            };

            const unblockSubmitBtn = (btn, strength) => {
                if (strength === "none" || strength === "weak") {
                    btn.disabled = true;
                } else {
                    btn.disabled = false;
                }
            };

            const findErrorMsg = (input) => {
                const passwForm = findParentNode(input, DOM.passwForm);
                return passwForm.querySelector(DOM.passwErrorMsg);
            };

            const showErrorMsg = (input) => {
                const errorMsg = findErrorMsg(input);
                errorMsg.classList.remove("js-hidden");
            };

            const hideErrorMsg = (input) => {
                const errorMsg = findErrorMsg(input);
                errorMsg.classList.add("js-hidden");
            };

            const passwordStrength = (input, strengthBar, btn) => {
                //getting password
                const passw = getPasswordVal(input);

                //check if there is an error
                const error = testPasswError(passw);

                if (error) {
                    showErrorMsg(input);
                } else {
                    //hide error messages
                    hideErrorMsg(input);

                    //finding strength
                    const strength = testPassw(passw);

                    //setting strength bar (value and styles)
                    setStrengthBar(strengthBar, strength);

                    //unblock submit btn only if password is moderate or stronger
                    unblockSubmitBtn(btn, strength);
                }
            };

            const passwordVisible = (passwField) => {
                const passwType = passwField.getAttribute("type");

                let visibilityStatus;

                if (passwType === "text") {
                    passwField.setAttribute("type", "password");

                    visibilityStatus = "hidden";
                } else {
                    passwField.setAttribute("type", "text");

                    visibilityStatus = "visible";
                }

                return visibilityStatus;
            };

            const changeVisibiltyBtnIcon = (btn, status) => {
                const hiddenPasswIcon = btn.querySelector(
                    `${DOM.passwVisibility_icon}[data-visible="hidden"]`
                );

                const visibilePasswIcon = btn.querySelector(
                    `${DOM.passwVisibility_icon}[data-visible="visible"]`
                );

                if (status === "visible") {
                    visibilePasswIcon.classList.remove("js-hidden");
                    hiddenPasswIcon.classList.add("js-hidden");
                } else if (status === "hidden") {
                    visibilePasswIcon.classList.add("js-hidden");
                    hiddenPasswIcon.classList.remove("js-hidden");
                }
            };

            const passwVisibilitySwitcher = (passwField, visibilityToggler) => {
                const visibilityStatus = passwordVisible(passwField);

                changeVisibiltyBtnIcon(visibilityToggler, visibilityStatus);
            };

            //*** EVENT LISTENERS
            DOM.passwInput.addEventListener("input", () => {
                passwordStrength(DOM.passwInput, DOM.strengthBar, DOM.submitBtn);
            });

            const passwVisibilityBtn = document.querySelector(DOM.passwVisibilityBtn);

            passwVisibilityBtn.addEventListener("click", (e) => {
                let toggler = findParentNode(e.target, DOM.passwVisibilityBtn);

                passwVisibilitySwitcher(DOM.passwInput, toggler);
            });
        </script>

    </body>

    </html>
<?php
}
?>