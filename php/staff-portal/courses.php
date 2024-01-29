<?php
session_start();


if (!isset($_SESSION["sess_user"])) {
    header("location: ../staff.php");
} else {
    include("../connection/config.php");
    $staffid = $_SESSION["sess_user"];
    $query = "SELECT * FROM staff  where staff_id='$staffid'";
    mysqli_select_db($conn, 'universityofsam');
    $user = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($user, MYSQLI_ASSOC);
    $role = $row['role'];

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

        <title>Courses' Informations | University of Sam</title>

        <!-- Custom fonts for this template-->
        <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


        <link href="../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="../../assets/css/staff-portal.css" rel="stylesheet">
        <style>
            .phperror {
                color: red;
            }

            #error {
                font-weight: 700;
            }
        </style>

    </head>

    <body id="page-top">
        <!-- ADD DATA -->
        <?php
        include('../connection/config.php');


        $idErr = $nameErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            function input_data($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            if (empty($_POST["courseid"])) {
                $idErr = "ID is required";
            }


            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
            }
        }

        if (isset($_POST['added'])) {
            if ($nameErr == "" && $idErr == "") {

                $Addquery = "INSERT INTO courses(course_id,course_name,faculty,study_level) values('$_POST[courseid]','$_POST[name]','$_POST[faculty]','$_POST[study]')";
                if (!mysqli_query($conn, $Addquery)) {
                    echo ('Error: ' . mysqli_error($conn));
                } else {
                    $_SESSION["Added"] = "A course has been added successfully!!";
                    echo '<script>alert("A course has been added successfully!!!");</script>';
                }
                mysqli_close($conn);
            } else {
                $_SESSION["ErrorMessage"] = "Please fill the form correctly!!";
                echo '<script>alert("Your information is invalid... Please try again one more time!!!");</script>';
            }
        }
        ?>

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./staff_portal.php">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <img src="../../assets/img/Logo.png" width="50px">
                    </div>
                    <div class="sidebar-brand-text mx-3">Staff Portal</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="./staff_portal.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
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
                        <span>Students</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Information</h6>
                            <a class="collapse-item" href="student_info.php">Profiles</a>
                            <a class="collapse-item" href="student_result.php">Results</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Staff</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Information</h6>
                            <a class="collapse-item" href="./staff_info.php">Profiles</a>
                        </div>
                    </div>
                </li>

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
                    <a class="btn btn-success btn-sm">Promote teamwork for increased productivity.</a>
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
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $row['name']; ?></span>
                                    <?php
                                    $power = base64_decode($row['profile_pic']);
                                    $photo_name = $row['name'] . '.png';
                                    $file_path = './img/';
                                    $file = fopen($file_path . $photo_name, 'wb');
                                    fwrite($file, $power);
                                    fclose($file);
                                    echo "  <img class='img-profile rounded-circle mb-2'  src='./img/$photo_name'  alt='Profile Picture from database'>";
                                    ?>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="./staff_profile.php">
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

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h2 class="m-0 font-weight-bold text-primary">Courses</h2>
                                    </div>
                                    <div class="col-md-4">
                                        <a type="button" class="btn btn-lg btn-primary" style="float:right" data-toggle="modal" data-target="#AddModal">+</a>
                                        <?php
                                        if (isset($_SESSION["ErrorMessage"])) {
                                        ?>
                                            <div class="error-message text-center text-danger p-3 mb-3" id="error"><?php echo $_SESSION["ErrorMessage"]; ?></div>
                                        <?php
                                            unset($_SESSION["ErrorMessage"]);
                                        }
                                        ?>

                                        <?php
                                        if (isset($_SESSION["Added"])) {
                                        ?>
                                            <div class="error-message text-center text-success p-3 mb-3" id="error"><?php echo $_SESSION["Added"]; ?></div>
                                        <?php
                                            unset($_SESSION["Added"]);
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Program ID</th>
                                                <th>Course Name</th>
                                                <th>Faculty</th>
                                                <th>Study Level</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Program ID</th>
                                                <th>Course Name</th>
                                                <th>Faculty</th>
                                                <th>Study Level</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            include("../connection/config.php");
                                            $sql1 = "SELECT * FROM courses";
                                            $result = mysqli_query($conn, $sql1);
                                            while ($row2 = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $row2['course_id']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $row2['course_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($row2['faculty'] == 0) {
                                                            echo '<b>Faculty of <span class="text-primary">Business</span></b>';
                                                        } elseif ($row2['faculty'] == 1) {
                                                            echo '<b>Faculty of <span class="text-danger">Health</span></b>';
                                                        } elseif ($row2['faculty'] == 2) {
                                                            echo '<b>Faculty of <span class="text-info">Science and Engineering</span></b>';
                                                        }
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        if ($row2['study_level'] == 0) {
                                                            echo '<span class="text-primary"><b>Undergraduate</b></span>';
                                                        } elseif ($row2['study_level'] == 1) {
                                                            echo '<span class="text-danger"><b>Postgraduate</b></span>';
                                                        }
                                                        ?>
                                                    </td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                </div>

                <!-- End of Main Content -->


                <!-- Footer -->
                <footer class=" sticky-footer bg-white">
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



        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Insert Modal-->
        <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="exampleModalLabel">Adding a new course</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" style="background:blue;color:#fff">Course Details</div>
                            <div class="card-body">
                                <form name="add" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                                    <div class="mb-3">
                                        <label class="small mb-1" for="courseid">Program ID <span class="phperror">*<?php echo $idErr; ?> </span></label>
                                        <input class="form-control" name="courseid" type="text" value="" placeholder="">
                                    </div>
                                    <!-- Form Group (username)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="name">Course Name <span class="phperror">*<?php echo $nameErr; ?> </span></label>
                                        <input class="form-control" name="name" type="text" value="">
                                    </div>

                                    <div class="mb-3">
                                        <label class="small mb-1" for="faculty">Faculty <span class="phperror">*</span></label>
                                        <br>
                                        <select id="faculty" name="faculty" class="form-control" required>
                                            <option selected disabled value="">Faculty</option>
                                            <option value="0">Faculty of Business</option>
                                            <option value="1">
                                                Faculty of Health
                                            </option>
                                            <option value="2">Faculty of Science and Engineering</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="small mb-1" for="study">Study Level <span class="phperror">*</span></label>
                                        <br>
                                        <select id="faculty" name="study" class="form-control" required>
                                            <option selected disabled value="">Study Level</option>
                                            <option value="0">Undergraduate</option>
                                            <option value="1">
                                                Postgraduate
                                            </option>

                                        </select>
                                    </div>




                            </div>

                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="submit" name="added">Submit</button>
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

        <!-- Page level plugins -->
        <script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../../assets/js/demo/datatables-demo.js"></script>


    </body>

    </html>
<?php
}
?>