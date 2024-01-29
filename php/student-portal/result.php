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


    $editquery = "SELECT 
        exam_result.student_id AS id, 
        student.student_name AS name, 
        student.year AS year, 
        courses.course_name AS course, 
        module_detail.module_name As module,
        courses.course_id AS CID,
        module_result.marks AS marks,
        exam_result.exam_id AS EID,
        exam_result.overall AS OID
        FROM 
            module_result 
        JOIN 
            exam_result ON module_result.exam_id=exam_result.exam_id 
        JOIN 
            module_detail ON module_result.module_id=module_detail.module_id
        JOIN
            student ON exam_result.student_id = student.student_id
        JOIN
            courses ON exam_result.course_id=courses.course_id
        WHERE 
            exam_result.student_id = $studentid";

    mysqli_select_db($conn, 'universityofsam');
    $edit = mysqli_query($conn, $editquery);
    $editrow = mysqli_fetch_array($edit, MYSQLI_ASSOC);
    if (!empty($editrow)) {
        if (!$editrow['EID'] == "") {
            $studentName = $editrow['name'];
            $studentYear = $editrow['year'];
            $courseName = $editrow['course'];
            $overall = $editrow['OID'];

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

                <title>Student Result | University of Sam</title>

                <!-- Custom fonts for this template-->
                <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
                <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

                <!-- Custom styles for this template-->
                <link href="../../assets/css/student-portal.css" rel="stylesheet">
                <style>

                </style>
            </head>

            <body id="page-top">

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

                            <!-- Begin Page Content -->
                            <div class="container-fluid">


                                <div class="container">
                                    <nav class="nav nav-borders">
                                        <a href="./student_portal.php" class="nav-link ms-0" target="__blank">Welcome Page</a>
                                        <a class="nav-link active ms-0" target="__blank">View Results</a>

                                    </nav>
                                    <h1 class="text-center p-3 mt-3 text-primary">Exam Result</h1>
                                </div>

                                <div class="container bootstrap snippets bootdey">
                                    <div class="panel-body inf-content p-3 m-3">



                                        <div class="table-responsive">
                                            <table class="table table-user-information table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <strong class="p-3">
                                                                <i class="fas fa-fw fa-user text-primary"></i>
                                                                Name
                                                            </strong>
                                                        </td>
                                                        <td class="text-primary" colspan="2">
                                                            <h4><strong> <?= $studentName; ?></strong></h4>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <strong class="p-3">
                                                                <i class="fas fa-fw fa-chalkboard-teacher text-primary"></i>
                                                                Course Name
                                                            </strong>
                                                        </td>
                                                        <td class="text-primary" colspan="2">
                                                            <strong><?= $courseName; ?></strong>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <strong class="p-3">
                                                                <i class="fas fa-fw fa-calendar text-primary"></i>
                                                                Year
                                                            </strong>
                                                        </td>
                                                        <td colspan="2">
                                                            <?php
                                                            if ($studentYear == 0) {
                                                                echo '<span class="text-primary"><b>Year 1</b></span>';
                                                            } elseif ($studentYear == 1) {
                                                                echo '<span class="text-danger"><b>Year 2</b></span>';
                                                            } elseif ($studentYear == 2) {
                                                                echo '<span class="text-warning"><b>Year 3</b></span>';
                                                            } elseif ($studentYear == 3) {
                                                                echo '<span class="text-info"><b>Year 4</b></span>';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <strong class="p-3">
                                                                <i class="fas fa-fw fa-award text-primary"></i>
                                                                Overall
                                                            </strong>
                                                        </td>
                                                        <td colspan="2">
                                                            <?php
                                                            if ($overall == 0) {
                                                                echo '<button class="btn btn-danger p-2"><b>Fail</b></button>';
                                                            } elseif ($overall == 1) {
                                                                echo '<button class="btn btn-warning p-2"><b>Pass</b></button>';
                                                            } elseif ($overall == 2) {
                                                                echo '<button class="btn btn-success p-2"><b>Merit</b></button>';
                                                            } elseif ($overall == 3) {
                                                                echo '<button class="btn btn-info p-2"><b>Distinction</b></button>';
                                                            } elseif ($overall == 4) {
                                                                echo '<button class="btn btn-primary m-2"><b>High Distinction</b></button>';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <h4 class="p-3 text-danger">MODULE</h4>
                                                        </td>
                                                        <td>
                                                            <h4 class="p-3 text-danger">Total Mark</h4>
                                                        </td>
                                                        <td>
                                                            <h4 class="p-3 text-danger">Grading Result</h4>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                    $sql1 = "SELECT 
                                                         exam_result.student_id AS id, 
                                                         student.student_name AS name, 
                                                         student.year AS year, 
                                                         courses.course_name AS course, 
                                                         module_detail.module_name As module,
                                                         courses.course_id AS CID,
                                                         module_result.marks AS marks,
                                                         exam_result.exam_id AS EID
                                                         FROM 
                                                             module_result 
                                                         JOIN 
                                                             exam_result ON module_result.exam_id=exam_result.exam_id 
                                                         JOIN 
                                                             module_detail ON module_result.module_id=module_detail.module_id
                                                         JOIN
                                                             student ON exam_result.student_id = student.student_id
                                                         JOIN
                                                             courses ON exam_result.course_id=courses.course_id
                                                         WHERE 
                                                         exam_result.student_id = $studentid";

                                                    mysqli_select_db($conn, 'universityofsam');
                                                    $blah = mysqli_query($conn, $sql1);

                                                    while ($row2 = mysqli_fetch_array($blah, MYSQLI_ASSOC)) {

                                                    ?>

                                                        <tr>
                                                            <td>
                                                                <div class="p-3 text-dark" style="font-weight:800">
                                                                    <?php echo $row2['module']; ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="p-3">
                                                                    <strong><?php if ($row2['marks'] < 40) { ?>
                                                                            <span class="text-danger p-3"><b> <?php echo $row2["marks"] ?></b></span>
                                                                        <?php } elseif ($row2['marks'] >= 40 && $row2['marks'] < 60) { ?>
                                                                            <span class="text-warning p-3"><b> <?php echo $row2["marks"] ?></b></span>
                                                                        <?php } elseif ($row2['marks'] >= 60 && $row2['marks'] < 70) { ?>
                                                                            <span class="text-success p-3"><b> <?php echo $row2["marks"] ?></b></span>
                                                                        <?php } elseif ($row2['marks'] >= 70 && $row2['marks'] < 80) { ?>
                                                                            <span class="text-info p-3"><b> <?php echo $row2["marks"] ?></b></span>
                                                                        <?php  } elseif ($row2['marks'] >= 80 && $row2['marks'] <= 100) { ?>
                                                                            <span class="text-primary p-3"><b> <?php echo $row2["marks"] ?></b></span>
                                                                        <?php } ?>
                                                                    </strong>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="p-3">
                                                                    <strong><?php if ($row2['marks'] < 40) { ?>
                                                                            <button class="btn btn-danger"><b>Fail</b></button>
                                                                        <?php } elseif ($row2['marks'] >= 40 && $row2['marks'] < 60) { ?>
                                                                            <button class="btn btn-warning"><b>Pass</b></button>
                                                                        <?php } elseif ($row2['marks'] >= 60 && $row2['marks'] < 70) { ?>
                                                                            <button class="btn btn-success"><b>Merit</b></button>
                                                                        <?php } elseif ($row2['marks'] >= 70 && $row2['marks'] < 80) { ?>
                                                                            <button class="btn btn-info"><b>Distinction</b></button>
                                                                        <?php  } elseif ($row2['marks'] >= 80 && $row2['marks'] <= 100) { ?>
                                                                            <button class="btn btn-primary"><b>High Distinction</b></button>
                                                                        <?php  } ?></strong>
                                                                </div>
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
                        <footer class="sticky-footer bg-white">
                            <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                    <span>Copyright &copy; UOS</span>
                                </div>
                            </div>
                        </footer>
                        <!-- End of Footer -->
                        <!-- End of Content Wrapper -->

                    </div>
                </div>
                <!-- End of Page Wrapper -->

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

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


            </body>

            </html>
<?php
        }
    } else {
        echo '<script>
    if (confirm("You have no exam result yet!!")) {
        window.location.href = "student_portal.php";
    } else {
        window.location.href = "student_portal.php";
    }
</script>';
    }
}

?>