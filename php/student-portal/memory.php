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

        <title>Memory Game | Student Portal</title>

        <!-- Custom fonts for this template-->
        <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="../../assets/css/student-portal.css" rel="stylesheet">

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
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Games for fun</h1>
                        </div>

                        <!-- Content Row -->
                        <div class="memory">
                            <h1>Tangram Memory Game</h1>
                            <p>Click cards and find matching tangrams</p>
                            <div class="board" id="tangramgrid"></div>
                            <svg style="display:none" viewBox="0 0 100 100">
                                <defs>
                                    <polygon id="tangram1" points="0 0, 50 50, 0 100" />
                                    <polygon id="tangram2" points="50 50, 75 25, 100 50, 75 75" />
                                    <polygon id="tangram3" points="0 100, 25 75, 75 75, 50 100" />
                                </defs>
                            </svg>
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

        <script>
            const classes = [
                'tcat',
                'tsquirrel',
                'theart',
                'trocket',
                'tbird',
                'thome',
                'tlotus',
                'tboat'
            ];

            const tangram = `
<div class="t">
  <svg viewbox="-50 -50 200 200" >
    <use class="bt-1" xlink:href="#tangram1" transform="translate(0,0)"/>
    <use class="bt-2 red" xlink:href="#tangram1" transform="translate(0,0) scale(-1,1) rotate(90 0 0)"/>
    <use class="st-1" xlink:href="#tangram1" transform="translate(25,75) scale(.5,.5) rotate(-90 0 0)"/>
    <use class="mt" xlink:href="#tangram1" transform="translate(100,49.5) scale(.7142,.7142) rotate(45 0 0)"/>
    <use class="st-2" xlink:href="#tangram1" transform="translate(100,50) scale(.5,.5) rotate(-180 0 0)"/>
    <use class="sq" xlink:href="#tangram2"/>
    <use class="rh" xlink:href="#tangram3"/>
  </svg>
</div>
`
            class MemoryGame {
                constructor(selector) {
                    this.selector = selector
                    this.init()
                }
                init() {
                    this.randomize()
                    this.buildGrid()
                    this.revealed = []
                }
                randomize() {
                    this.classes = this.shuffle(classes.concat(classes))
                }
                shuffle(array) {
                    array.sort(function(a, b) {
                        return 0.5 - Math.random()
                    });
                    return array;
                }
                buildGrid() {
                    let html = ''
                    for (let i = 0; i < this.classes.length; i++) {
                        html += tangram;
                    }
                    this.selector.innerHTML = html;
                    this.cards = this.selector.querySelectorAll('.t')
                    this.classes.forEach((el, i) => {
                        const card = this.cards[i]
                        card.classList.add(el)
                        card.setAttribute('data-class', el)
                        this.addCardListeners(card)
                    })

                }
                checkMatch() {
                    return this.revealed.length === 2 && this.revealed[0].getAttribute('data-class') === this.revealed[1].getAttribute('data-class')
                }
                addCardListeners(el) {

                    el.addEventListener('mouseenter', (e) => {

                        if (el.classList.contains('revealed')) {
                            return
                        }

                        if (this.revealed.length < 2) {
                            return
                        }

                        Array.prototype.slice.call(this.revealed).forEach((item) => {
                            item.classList.remove('revealed')
                        })
                        this.revealed = []
                    })

                    el.addEventListener('click', (e) => {

                        if (el.classList.contains('revealed')) {
                            return
                        }

                        el.classList.add('revealed');
                        this.revealed.push(el)
                        if (this.checkMatch()) {
                            Array.prototype.slice.call(this.revealed).forEach((item) => {
                                item.classList.add('hidden')
                                this.revealed = []
                            })
                        }

                    }, false);

                }
            }

            let memory = new MemoryGame(document.getElementById("tangramgrid"));
        </script>
    </body>

    </html>
<?php
}
?>