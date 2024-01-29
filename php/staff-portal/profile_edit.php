<?php
session_start();



if (!isset($_SESSION["sess_user"])) {
    header("location: ../staff.php");
} else {
    include("../connection/config.php");
    $staffid = $_SESSION["sess_user"];
    $query = "SELECT * FROM staff where staff_id='$staffid'";
    mysqli_select_db($conn, 'universityofsam');
    $user = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($user, MYSQLI_ASSOC);


    if (isset($_GET['editid'])) {
        $userId = $_GET['editid'];
        $editquery = "SELECT * FROM staff where staff_id='$userId'";

        mysqli_select_db($conn, 'universityofsam');
        $edit = mysqli_query($conn, $editquery);
        $editrow = mysqli_fetch_array($edit, MYSQLI_ASSOC);
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

        <title>Editing Staff Profile | University of Sam</title>

        <!-- Custom fonts for this template-->
        <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="../../assets/css/staff-portal.css" rel="stylesheet">

    </head>

    <body id="page-top">


        <?php
        if (isset($_POST['changes'])) {
            include("../connection/config.php");

            $updatedName =  $_POST['name'];
            $updatedEmail = $_POST['email'];
            $updatedphno = $_POST['phno'];
            $updateddob = $_POST['dob'];
            $updatedadd = $_POST['address'];
            $updatedDepartment = $_POST['department'];
            $sql = "UPDATE staff SET name='$updatedName', date_of_birth='$updateddob',email='$updatedEmail',phno='$updatedphno',address='$updatedadd',department='$updatedDepartment' WHERE staff_id='" . $userId . "'";

            $updateResult = mysqli_query($conn, $sql);

            if ($updateResult) {
                echo "<script>
                if (confirm('Your Information has been updated!!')) {
                    window.location.href = 'profile_edit.php?editid=$userId';
                } else {
                    window.location.href = 'profile_edit.php?editid=$userId';
                };</script>";
            } else {
                echo '<script>alert("Error: Unable to update the record.");</script>';
            }
        }


        // Update image into database
        if (isset($_POST['newimage'])) {
            $file = $_FILES['image'];
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {

                // Convert image data to binary
                $dataupdate = file_get_contents($file['tmp_name']);


                // Convert binary data to base64
                $base = base64_encode($dataupdate);

                // Update image into photos table
                $photoedit = "UPDATE staff SET profile_pic='$base' WHERE staff_id='" . $userId . "'";

                if ($conn->query($photoedit) === TRUE) {

                    echo "<script>
                if (confirm('Your Profile Picture has been updated!!')) {
                    window.location.href = 'profile_edit.php?editid=$userId';
                } else {
                    window.location.href = 'profile_edit.php?editid=$userId';
                };</script>";
                } else {
                    echo '<script>alert("Error: Unable to update the record.");</script>';
                }
            } else {
                echo '<script>alert("Error: Please upload your file first");</script>';
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
                            <a class="collapse-item" href="./student_info.php">Profiles</a>
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






                        <!-- Page Heading -->


                        <div class="container-xl px-4 mt-4">
                            <!-- Account page navigation-->
                            <nav class="nav nav-borders">
                                <a href="staff_info.php" class="nav-link ms-0" target="__blank">Staffs' Information</a>
                                <a class="nav-link active ms-0" target="__blank">Profile Edits</a>

                            </nav>
                            <hr class="mt-0 mb-4">
                            <div class="row">
                                <div class="col-xl-4">
                                    <!-- Profile picture card-->
                                    <div class="card mb-4 mb-xl-0">
                                        <div class="card-header">Profile Picture</div>
                                        <div class="card-body text-center">

                                            <!-- Profile picture image-->

                                            <?php
                                            $data = base64_decode($editrow['profile_pic']);
                                            $data_photo_name = $editrow['name'] . '.png';
                                            $data_file_path = './img/';
                                            $data_file = fopen($data_file_path . $data_photo_name, 'wb');
                                            fwrite($data_file, $data);
                                            fclose($data_file);
                                            echo "  <img class='img-profile rounded-circle mb-2'  src='./img/$data_photo_name' width='200px' height='200px' alt='Profile Picture from database'>";
                                            ?>


                                            <!-- Profile picture help block-->
                                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                            <!-- Profile picture upload button-->
                                            <form method="post" enctype="multipart/form-data">
                                                <button class="btn btn-primary" type="submit" name="newimage">Upload new image</button>


                                                <input class="p-3" type="file" name="image">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header">Account Details</div>
                                        <div class="card-body">
                                            <form name="changes" action="" method="POST">

                                                <div class="mb-3">
                                                    <label class="small mb-1" for="staffid">Staff ID</label>
                                                    <input class="form-control" disabled id="staffid" type="text" value="<?= $editrow['staff_id']; ?>">
                                                </div>
                                                <!-- Form Group (username)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="name">Name</label>
                                                    <input class="form-control" name="name" type="text" value="<?= $editrow['name']; ?>">
                                                </div>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="department">Department</label>
                                                        <input class="form-control" name="department" type="text" value="<?= $editrow['department']; ?>">
                                                        <!-- Form Group (Gender)-->
                                                        <!-- Form Group (dob)-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="dob">Date of Birth</label>
                                                        <input class="form-control" name="dob" type="text" value="<?= $editrow['date_of_birth']; ?>">
                                                    </div>
                                                </div>
                                                <!-- Form Row        -->
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="phno">Phone Number</label>
                                                        <input class="form-control" name="phno" type="tel" value="<?= $editrow['phno']; ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="address">Address</label>
                                                        <input class="form-control" name="address" type="text" value="<?= $editrow['address']; ?>">
                                                    </div>

                                                </div>
                                                <!-- Form Group (email address)-->
                                                <div class="mb-3">

                                                    <label class="small mb-1" for="email">Email <span class="text-danger">*(you need this to login for portal)</span></label>
                                                    <input class="form-control" name="email" type="email" value="<?= $editrow['email']; ?>">

                                                </div>
                                                <!-- Form Row-->

                                                <!-- Form Group (birthday)-->

                                        </div>

                                        <!-- Save changes button-->
                                        <button class="btn btn-primary" type="submit" name="changes">Save changes</button>
                                        </form>
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
            </div>
            <!-- End of Content Wrapper -->

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
?>