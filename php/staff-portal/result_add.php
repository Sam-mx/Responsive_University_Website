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

    if (isset($_GET['editid'])) {
        $userId = $_GET['editid'];
        $coursequery = "SELECT 
                            exam_result.course_id,courses.course_name 
                        FROM 
                            exam_result 
                        JOIN
                            courses ON exam_result.course_id = courses.course_id
                        WHERE 
                            exam_id='$userId'";
        mysqli_select_db($conn, 'universityofsam');
        $courseuser = mysqli_query($conn, $coursequery);
        $courserow = mysqli_fetch_array($courseuser, MYSQLI_ASSOC);
        $courseid = $courserow['course_id'];
        $coursename = $courserow['course_name'];
    }

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

        <title>Staff Portal | University of Sam</title>

        <!-- Custom fonts for this template-->
        <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="../../assets/css/staff-portal.css" rel="stylesheet">

    </head>

    <body id="page-top">

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
                            <a class="collapse-item" href="./student_result.php">Results</a>
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



                        <div class="container">
                            <nav class="nav nav-borders">
                                <a href="./student_result.php" class="nav-link ms-0" target="__blank">Student' Results</a>
                                <a href="./result_view.php?editid=<?php echo $userId; ?>" class="nav-link ms-0" target="__blank">View Results</a>
                                <a class="nav-link active ms-0" target="__blank">Add Results</a>

                            </nav>
                            <h1 class="text-center p-3 mt-3 text-primary">Add Result</h1>
                        </div>

                        <div class="container bootstrap snippets bootdey">
                            <div class="panel-body inf-content p-3 m-3">
                                <div class="table-responsive">
                                    <table class="table table-user-information">
                                        <tbody>


                                            <tr>
                                                <td>
                                                    <strong class="p-3">
                                                        <i class="fas fa-fw fa-chalkboard-teacher text-primary"></i>
                                                        Course Name
                                                    </strong>
                                                </td>
                                                <td class="text-primary">
                                                    <strong><?= $coursename; ?></strong>
                                                </td>
                                            </tr>


                                            <tr>
                                                <th><strong class="p-3 text-danger">Module Name</strong></th>
                                                <th><strong class="p-3 text-danger">Action</strong></th>
                                            </tr>

                                            <?php
                                            $sql1 = "SELECT 
                                                        module_name AS name,
                                                        module_id AS MID 
                                                    FROM
                                                        module_detail
                                                    WHERE
                                                        course_id = '$courseid'";

                                            mysqli_select_db($conn, 'universityofsam');
                                            $blah = mysqli_query($conn, $sql1);

                                            while ($row2 = mysqli_fetch_array($blah, MYSQLI_ASSOC)) {

                                            ?>

                                                <tr>
                                                    <td>
                                                        <div class="p-3">
                                                            <strong><?php echo $row2['name']; ?></strong>
                                                        </div>
                                                    </td>



                                                    <td>
                                                        <div class="p-3">
                                                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#UpdateModal" data-user-id="<?php echo $row2['MID']; ?>">Add</button>
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
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Modal for update-->
        <div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Editing Mark on</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="editUser" action="add_module.php">
                            <div class="mb-3">
                                <label class="small mb-1" for="name"><strong class="text-primary">Module Name</strong></label>
                                <input class="form-control" name="name" type="text" value="" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="mark"><strong class="text-primary">Marks</strong></label>
                                <input class="form-control" name="mark" type="text" value="">
                            </div>

                            <input type="hidden" name="Module_id" class="form-control">
                            <input type="hidden" name="Exam_id" class="form-control">

                            <button class="btn btn-success" style="float:right" type="submit" name="added">Add</button>
                        </form>
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const updateModal = new bootstrap.Modal(document.getElementById('UpdateModal'));
                const modalTitle = document.querySelector('#UpdateModal .modal-title');
                const form = document.querySelector('#editUser');
                document.querySelectorAll('[data-bs-target="#UpdateModal"]').forEach(function(button) {
                    button.addEventListener('click', function() {
                        const ModuleId = button.getAttribute('data-user-id');
                        fetch('fetchModuleData.php?id=' + ModuleId)
                            .then(response => response.json())
                            .then(data => {
                                modalTitle.textContent = 'Adding Mark to ' + data.module_name;
                                form.name.value = data.module_name;
                                form.Module_id.value = ModuleId;
                                form.Exam_id.value = <?php echo $userId ?>;
                            });
                        updateModal.show();
                    });
                });
            });
        </script>
    </body>

    </html>
<?php
}
?>