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

        <title>Student Informations | University of Sam</title>

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


        $idErr = $nameErr = $emailErr = $passwordErr  = $mobilenoErr = $addErr  = $dobErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            function input_data($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            if (empty($_POST["studentid"])) {
                $idErr = "ID is required";
            }


            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
            }

            if (empty($_POST['email'])) {
                $emailErr =  "Email is required";
            } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }

            if (empty($_POST['password']) || empty($_POST['confirmPassword']) || $_POST['password'] !== $_POST['confirmPassword']) {
                $passwordErr = "Password should be match";
            }



            //Number Validation  
            if (empty($_POST["phno"])) {
                $mobilenoErr = "Mobile no is required";
            } else {
                $mobileno = input_data($_POST["phno"]);
                // check if mobile no is well-formed  
                if (!preg_match("/^[0-9]*$/", $mobileno)) {
                    $mobilenoErr = "Only numeric value is allowed.";
                }
                //check mobile no length should not be less and greater than 11  
                if (strlen($mobileno) != 11) {
                    $mobilenoErr = "Mobile number must contain 11 digits.";
                }
            }

            if (empty($_POST["address"])) {
                $addErr = "This field is required";
            }

            if (empty($_POST["dob"])) {
                $dobErr = "You should choose your birth date";
            }
        }

        if (isset($_POST['added'])) {
            if ($idErr == "" && $nameErr == "" && $emailErr == "" && $passwordErr  == "" && $mobilenoErr == "" && $addErr == "" && $dobErr == "") {

                $Addquery = "INSERT INTO student(student_id,student_name,gender,date_of_birth,email,phno,address,course_id,year,nickname,password,profile_pic) 
    values('$_POST[studentid]','$_POST[name]','$_POST[gender]','$_POST[dob]','$_POST[email]','$_POST[phno]','$_POST[address]','$_POST[course]','$_POST[Year]',NULL,'$_POST[password]',NULL)";
                if (!mysqli_query($conn, $Addquery)) {
                    echo ('Error: ' . mysqli_error($conn));
                } else {
                    $_SESSION["Added"] = "Student's information has been added successfully!!";
                    echo '<script>alert("Student\'s information has been added successfully!!!");</script>';
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

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h2 class="m-0 font-weight-bold text-primary">University of Sam's Students</h2>
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
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Date of Birth</th>
                                                <th>Phone Number</th>
                                                <th>Address</th>
                                                <th>Course Name</th>
                                                <th>Faculty</th>
                                                <th>Year</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Date of Birth</th>
                                                <th>Phone Number</th>
                                                <th>Address</th>
                                                <th>Course Name</th>
                                                <th>Faculty</th>
                                                <th>Year</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            include("../connection/config.php");
                                            $sql1 = "SELECT * FROM student";
                                            $result = mysqli_query($conn, $sql1);
                                            while ($row2 = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                                                $coursefetch = "SELECT course_name,faculty FROM courses where course_id='$row2[course_id]'";
                                                $courseresult = mysqli_query($conn, $coursefetch);
                                                while ($course = mysqli_fetch_array($courseresult, MYSQLI_ASSOC)) {
                                            ?>

                                                    <tr>
                                                        <td>
                                                            <?php echo $row2['student_id']; ?>
                                                        </td>

                                                        <td>
                                                            <?php echo $row2['student_name']; ?>
                                                        </td>

                                                        <td>
                                                            <?php echo $row2['email']; ?>
                                                        </td>

                                                        <td>
                                                            <?php
                                                            if ($row2['gender'] == 0) {
                                                                echo '<div class="text-center"><i class="fas fa-mars text-primary"></i></div>';
                                                            } else {
                                                                echo '<div class="text-center"><i class="fas fa-venus text-danger"></i></div>';
                                                            }
                                                            ?>
                                                        </td>

                                                        <td>
                                                            <?php echo $row2['date_of_birth']; ?>
                                                        </td>

                                                        <td>
                                                            <?php echo $row2['phno']; ?>
                                                        </td>

                                                        <td>
                                                            <?php echo $row2['address']; ?>
                                                        </td>

                                                        <td>
                                                            <?php echo $course['course_name']; ?>

                                                        </td>

                                                        <td>
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



                                                        <td>
                                                            <?php
                                                            if ($row2['year'] == 0) {
                                                                echo '<span class="text-primary"><b>Year 1</b></span>';
                                                            } elseif ($row2['year'] == 1) {
                                                                echo '<span class="text-danger"><b>Year 2</b></span>';
                                                            } elseif ($row2['year'] == 2) {
                                                                echo '<span class="text-warning"><b>Year 3</b></span>';
                                                            } elseif ($row2['year'] == 3) {
                                                                echo '<span class="text-info"><b>Year 4</b></span>';
                                                            }
                                                            ?>
                                                        </td>

                                                        <td>

                                                            <div class="d-grid gap-2 d-sm-flex ">
                                                                <a type="button" class="btn btn-success btn-sm" href=" student_update.php?editid=<?php echo $row2['student_id']; ?>">
                                                                    Update
                                                                </a>
                                                                <a type="button" class="btn btn-danger btn-sm" href=" student_delete.php?deleteid=<?php echo $row2['student_id']; ?>">
                                                                    Delete
                                                                </a>
                                                            </div>

                                                        </td>
                                                    </tr>
                                            <?php }
                                            } ?>
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
                        <h5 class="modal-title text-primary" id="exampleModalLabel">Adding a new student's information</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" style="background:blue;color:#fff">Account Details</div>
                            <div class="card-body">
                                <form name="add" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                                    <div class="mb-3">
                                        <label class="small mb-1" for="studentid">Student ID <span class="phperror">*<?php echo $idErr; ?> </span></label>
                                        <input class="form-control" name="studentid" type="text" value="" placeholder="00000">
                                    </div>
                                    <!-- Form Group (username)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="name">Name <span class="phperror">*<?php echo $nameErr; ?> </span></label>
                                        <input class="form-control" name="name" type="text" value="">
                                    </div>
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="small mb-1" for="Year">Year <span class="phperror">*</span></label>
                                                <br>
                                                <select id="Year" name="Year" class="form-control" required>
                                                    <option selected disabled value="">Year</option>
                                                    <option value="0">Year 1</option>
                                                    <option value="1">
                                                        Year 2
                                                    </option>
                                                    <option value="2">Year 3</option>
                                                    <option value="3">Year 4</option>
                                                </select>
                                            </div>
                                            <!-- Form Group (Gender)-->
                                            <!-- Form Group (dob)-->
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="small mb-1" for="gender">Gender <span class="phperror">*</span></label>
                                                <br>
                                                <select id="gender" name="gender" class="form-control" required>\
                                                    <option selected disabled value="">Gender</option>
                                                    <option value="0">Male</option>
                                                    <option value="1">
                                                        Female
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Form Row        -->
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="phno">Phone Number <span class="phperror">*<?php echo $mobilenoErr; ?> </span></label>
                                            <input class="form-control" name="phno" type="tel" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="address">Address <span class="phperror">*<?php echo $addErr; ?> </span></label>
                                            <input class="form-control" name="address" type="text" value="">
                                        </div>

                                    </div>

                                    <div class="mb-3"><label class="small mb-1" for="dob">Date of Birth <span class="phperror">*<?php echo $dobErr; ?> </span></label>
                                        <input class="form-control" name="dob" type="text" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="course">Course Name <span class="phperror">*</span></label>
                                        <br>
                                        <select id="course" name="course" class="form-control" required>
                                            <option selected disabled value="">Course Name</option>
                                            <option value="1101">Bachelor of Applied Finance</option>
                                            <option value="1102">Bachelor of Business</option>
                                            <option value="1103">Bachelor of Business Analytics</option>
                                            <option value="1104">Bachelor of Commerce</option>
                                            <option value="1105">Bachelor of Economics</option>
                                            <option value="1106">Bachelor of Marketing and Media</option>
                                            <option value="1107">Bachelor of Professional Accounting</option>
                                            <option value="1201">Bachelor of Engineering (Honours)</option>
                                            <option value="1301">Bachelor of Chiropractic Science</option>
                                            <option value="1302">Bachelor of Clinical Science</option>
                                            <option value="1303">Bachelor of Exercise and Sports Science</option>
                                            <option value="1304">Bachelor of Medical Sciences</option>
                                            <option value="1305">Bachelor of Speech and Hearing Sciences</option>
                                            <option value="1401">Bachelor of Cyber Security</option>
                                            <option value="1402">Bachelor of Game Design and Development</option>
                                            <option value="1403">Bachelor of Information Technology</option>
                                            <option value="1501">Bachelor of Arts</option>
                                            <option value="1502">Bachelor of Security Studies</option>
                                            <option value="1503">Bachelor of Social Science</option>
                                            <option value="2101">Master of Accounting</option>
                                            <option value="2102">Master of Applied Economics</option>
                                            <option value="2103">Master of Applied Finance</option>
                                            <option value="2104">Master of Banking and Finance</option>
                                            <option value="2105">Master of Business Analytics</option>
                                            <option value="2106">Master of Business Administration</option>
                                            <option value="2107">Master of Commerce</option>
                                            <option value="2108">Master of Engineering Management</option>
                                            <option value="2109">Master of Finance</option>
                                            <option value="2110">Master of Management</option>
                                            <option value="2111">Master of Marketing</option>
                                            <option value="2112">Master of Professional Accounting</option>
                                            <option value="2201">Master of Engineering in Electronics Engineering</option>
                                            <option value="2301">Doctor of Medicine</option>
                                            <option value="2302">Doctor of Physiotherapy</option>
                                            <option value="2303">Master of Chiropractic</option>
                                            <option value="2304">Master of Clinical Audiology</option>
                                            <option value="2305">Master of Public Health</option>
                                            <option value="2401">Master of Data Science</option>
                                            <option value="2402">Master of Information Systems Management</option>
                                            <option value="2403">Master of Information Technology in Artificial Intelligence</option>
                                            <option value="2404">Master of Information Technology in Cyber Security</option>
                                            <option value="2405">Master of Information Technology in Internet of Things</option>
                                            <option value="2406">Master of Information Technology in Networking</option>
                                            <option value="2501">Master of Counter Terrorism</option>
                                            <option value="2502">Master of Criminology</option>
                                            <option value="2503">Master of Cyber Security Analysis</option>
                                            <option value="2504">Master of Intelligence</option>
                                            <option value="2505">Master of Security and Strategic Studies</option>

                                        </select>
                                    </div>



                                    <!-- Form Group (email address)-->
                                    <div class="mb-3">

                                        <label class="small mb-1" for="email">Email <span class="text-danger">*(students will need this to login for portal)</span></label>
                                        <input class="form-control" name="email" type="email" value="">
                                        <span class="phperror"><?php echo $emailErr; ?> </span>

                                    </div>
                                    <!-- Form Row-->
                                    <div class="mb-3">

                                        <label class="small mb-1" for="password">Password <span class="text-danger">*(students will need this to login for portal)</span></label>
                                        <input class="form-control" name="password" type="password" value="">

                                    </div>
                                    <div class="mb-3">

                                        <label class="small mb-1" for="confirmPassword">Confirm Password <span class="text-danger">*(students will need this to login for portal)</span></label>
                                        <input class="form-control" name="confirmPassword" type="password" value="">
                                        <span class="phperror"><?php echo $passwordErr; ?> </span>
                                    </div>

                                    <!-- Form Group (birthday)-->

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