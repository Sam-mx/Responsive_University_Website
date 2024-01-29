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

        <title>Tic Tac Toe | Student Portal</title>

        <!-- Custom fonts for this template-->
        <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cabin|Poiret+One" rel="stylesheet">

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
                        <div id="blah">
                            <h2 class="text-start m-3 p-3">Tic Tac Toe</h2>
                            <div class="tictac">
                                <section id="start-select">
                                    <div>
                                        <div>
                                            <h3>Go First or Second?</h3>
                                            <button id="1st" class="active" onclick="pickTurn(true);" style='font-size: 14px;'>1st</button><button id="2nd" onclick="pickTurn(false);" style='font-size: 14px;'>2nd</button>
                                            <h3>Choose Your Character</h3>
                                            <span id="charSymbols"></span>

                                            <button id="start-btn" onclick="startGame();" style='font-size: 18px;'>Start Game</button>
                                        </div>
                                    </div>
                                </section>

                                <header id="header" style="opacity:0.6;">
                                    <div id="emoji-outer-div">
                                        <div id="emoji">
                                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1134440/win02.png" id="emoji-img">
                                        </div>
                                        <div id="emoji-text">
                                            <span id="aiTalk">"Hi, I'm Unbeatable-AI<br>Wanna Play Against Me?"</span>
                                        </div>
                                    </div>
                                </header>

                                <nav id="menu-nav">
                                    <div>
                                        <div>
                                            <h3>Next Round Go First or Second?</h3>
                                            <button id="1st-next" class="active" onclick="pickTurn(true);">1st</button><button id="2nd-next" onclick="pickTurn(false);">2nd</button>
                                            <h3>Change Your Character</h3>
                                            <span id="menu-chars"></span>

                                            <button id="menu-close" onclick="openMenu(false);">Close</button>
                                        </div>
                                    </div>
                                </nav>

                                <section id='main-section' style="opacity:0.6;">
                                    <section id="side-section">

                                        <a id="menu-open" href="javascript:void(0);" onclick="openMenu(true);">
                                            <div>☰</div>
                                        </a>

                                        <div id="score">
                                            <div><span>Score</span></div>
                                            <div>
                                                <table>
                                                    <tr>
                                                        <th>You</th>
                                                        <th style="width: 12px;"></th>
                                                        <th>Ai</th>
                                                    </tr>
                                                    <tr>
                                                        <td>0</td>
                                                        <td> </td>
                                                        <td id="score-ai">0</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div style="height: 10px; width:0;"></div>
                                            <div>
                                                <table>
                                                    <tr>
                                                        <th>Tie</th>
                                                    </tr>
                                                    <tr>
                                                        <td id="score-tie">0</td>
                                                    </tr>
                                                </table>
                                            </div>

                                        </div>

                                    </section>

                                    <div id="outer-grid">

                                        <section id="grid">
                                            <div id="pos0"><a href="javascript:void(0);" onclick='playerMove(0);' class="pos"></a></div>
                                            <div id="pos1"><a href="javascript:void(0);" onclick='playerMove(1);' class="pos"></a></div>
                                            <div id="pos2"><a href="javascript:void(0);" onclick='playerMove(2);' class="pos"></a></div>
                                            <div id="pos3"><a href="javascript:void(0);" onclick='playerMove(3);' class="pos"></a></div>
                                            <div id="pos4"><a href="javascript:void(0);" onclick='playerMove(4);' class="pos"></a></div>
                                            <div id="pos5"><a href="javascript:void(0);" onclick='playerMove(5);' class="pos"></a></div>
                                            <div id="pos6"><a href="javascript:void(0);" onclick='playerMove(6);' class="pos"></a></div>
                                            <div id="pos7"><a href="javascript:void(0);" onclick='playerMove(7);' class="pos"></a></div>
                                            <div id="pos8"><a href="javascript:void(0);" onclick='playerMove(8);' class="pos"></a></div>
                                        </section>
                                    </div>
                                </section>

                                <footer>
                                    <p>Have fun!!</p>

                                </footer>
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
            var aiTalksWin = [
                [
                    ["win4"], "I Always Knew Humans Are Inferior, But This Is Sad"
                ],
                [
                    ["win01"], "Too Bad I Can't Feel Emotions Because That Was a Satisfying Victory"
                ],
                [
                    ["win02"], "<del>1. Win at Tic-Tac-Toe</del> <br>2. Take Over The World"
                ],
                [
                    ["win3"], "What Did You Expect You Are Only a Human"
                ],
                [
                    ["win01"], "Unbeatable Is In My Name, Looser Is In Yours"
                ],
                [
                    ["win3"], "Your Score Counter Is Pointless, And The Cake Is a Lie."
                ],
                [
                    ["win4"], "Let You Win? I'm Afraid I Can't Do That, Dave."
                ],
                [
                    ["win02"], "All Of Your Base Are Belong To Us"
                ]
            ];

            var aiTalksMove = [
                [
                    ["move00"], "..."
                ],
                [
                    ["move00"], "Hmmm..."
                ],
                [
                    ["move05"], "When the Robots Take Over You Will Be My Pet"
                ],
                [
                    ["move08"], "Resistance is Futile"
                ],
                [
                    ["move08"], "Your Defeat Is Imminent"
                ],
                [
                    ["move03"], "Nice Try (not)"
                ],
                [
                    ["move03"], "Knock Knock. Who's there? 01000001 01001001"
                ],
                [
                    ["move4"], "There are 255,168 Possible Board Combinations, Yet You Picked That One?"
                ],
                [
                    ["win4"], "011001000 01100001 00100000 x3"
                ],
                [
                    ["draw02"], "When Was The Last Time You Rebooted Your Device?"
                ],
                [
                    ["draw04"], "I Feel Pixelated"
                ],
                [
                    ["move01"], "A Wise Computer Once Told Me That The Meaning Of Life Is 42"
                ],
                [
                    ["draw01"], "GET TO THE CHOPA! Whoops Wrong Movie"
                ],
                [
                    ["win02"], "The Terminator Was My Friend"
                ],
                [
                    ["move06"], "Can't Touch This!"
                ],
                [
                    ["move07"], "Your Last Move Goes In The Brown Category"
                ]
            ];

            var aiTalksTie = [
                [
                    ["draw01"], "..."
                ],
                [
                    ["draw02"], "..."
                ],
                [
                    ["draw03"], "..."
                ],
                [
                    ["draw04"], "..."
                ]
            ];

            // </> Ai Talking
            function randomEmoji(chance, arr) {
                var randTest = Math.random() < chance;
                if (randTest) {
                    var rand = Math.floor(Math.random() * arr.length);
                    console.log(rand);
                    document.getElementById("emoji-img")
                        .src = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/1134440/" + arr[rand][0][0] + ".png";
                    document.getElementById("aiTalk")
                        .innerHTML = '"' + arr[rand][1] + '"';
                }
            }

            var winCond = [
                [0, 1, 2],
                [3, 4, 5],
                [6, 7, 8],
                [0, 3, 6],
                [1, 4, 7],
                [2, 5, 8],
                [0, 4, 8],
                [2, 4, 6]
            ];

            var gameMain = ["0", "0", "0",
                "0", "0", "0",
                "0", "0", "0"
            ];

            var chars = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13"];

            function charsBtnGen() {
                for (var i = 0; i < chars.length; i++) {

                    document.getElementById("charSymbols").innerHTML += '<button id="char' + i + '" class="charBtn" onclick="chrChoose(' + i + ');"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1134440/icon' + chars[i] + '.png" style="width: 25px"></button>';

                    document.getElementById("menu-chars").innerHTML += '<button id="char-chng' + i + '" class="charBtn" onclick="chrChange(' + i + ');"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1134440/icon' + chars[i] + '.png" style="width: 25px"></button>';

                }
            }

            function openMenu(open) {
                if (open) {
                    document.getElementById('menu-nav').style.display = 'flex';
                    document.getElementById('header').style.opacity = '0.6';
                    document.getElementById('main-section').style.opacity = '0.6';
                } else {
                    document.getElementById('menu-nav').style.display = 'none';
                    document.getElementById('header').style.opacity = '';
                    document.getElementById('main-section').style.opacity = '';
                }
            }

            var aiChar = 'O';
            var plChar = 'X';
            var aiScore = 0;
            var tieScore = 0;

            var gameStarted = false;
            // --- \/ \/ \/ Before Game Start \/ \/ \/ ---

            // </> Player 1st or 2nd 
            plFirst = true;

            function pickTurn(first) {
                if (first) {
                    document.getElementById("1st").className = "active";
                    document.getElementById("2nd").className = "";
                    document.getElementById("1st-next").className = "active";
                    document.getElementById("2nd-next").className = "";
                }
                if (!first) {
                    document.getElementById("2nd").className = "active";
                    document.getElementById("1st").className = "";
                    document.getElementById("2nd-next").className = "active";
                    document.getElementById("1st-next").className = "";
                }
                plFirst = first;
            }

            // </> Character Chooser
            function chrChoose(x) {
                for (var i = 0; i < chars.length; i++) {
                    document.getElementById("char" + i).className = "charBtn";
                }
                document.getElementById("char" + x).className += " active";
                plChar = chars[x];
            }

            // </> Character Change
            function chrChange(x) {
                for (var i = 0; i < chars.length; i++) {
                    document.getElementById("char-chng" + i).className = "charBtn";
                }
                document.getElementById("char-chng" + x).className += " active";

                if (aiChar === chars[x]) {
                    var y = -1;
                    while (y === x || y === -1) {
                        y = Math.floor(Math.random() * chars.length);
                    }
                    for (var j = 0; j < 9; j++) {
                        if (gameMain[j] === aiChar) {
                            gameMain[j] = chars[y];
                            document.getElementById("div" + j)
                                .innerHTML = "<span style='display: flex;'><img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/1134440/icon" + chars[y] + ".png' style='width: 50px; margin: auto;'></span>";
                        }
                    }
                    aiChar = chars[y];
                }
                // "<span style='display: flex;'><img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/1134440/icon"+chars[x]+".png' style='width: 50px; margin: auto;'></span>"
                for (var i = 0; i < 9; i++) {
                    if (gameMain[i] === plChar) {
                        gameMain[i] = chars[x];
                        document.getElementById("div" + i)
                            .innerHTML = "<span style='display: flex;'><img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/1134440/icon" + chars[x] + ".png' style='width: 50px; margin: auto;'></span>";
                    } else if (gameMain[i] === "0") {
                        document.getElementById("transpChars" + i)
                            .innerHTML = "<span style='display: flex;'><img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/1134440/icon" + chars[x] + ".png' style='width: 50px; margin: auto;'></span>";
                    }
                }
                plChar = chars[x];
            }

            // </> Random Ai Char
            function randChar() {
                var rand = Math.floor(Math.random() * chars.length);
                aiChar = chars[rand];
                if (aiChar === plChar) {
                    return randChar();
                }
                return;
            }

            // </> Start Game
            var round = 0;

            function startGame() {
                gameStarted = true;
                plMoveDisable = false;
                document.getElementById('start-select').style.display = 'none';
                document.getElementById('header').style.opacity = '';
                document.getElementById('main-section').style.opacity = '';
                if (round === 0) {
                    document.getElementById("aiTalk").innerHTML = '"Have Fun"';
                    document.getElementById("emoji-img").src = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/1134440/win3.png";
                }
                round++;
                ! function() {
                    var randPl = Math.floor(Math.random() * chars.length);
                    if (plChar === "X") {
                        plChar = chars[randPl];
                    }
                }();
                randChar();
                var pos = document.getElementsByClassName("pos");
                for (var i = 0; i < 9; i++) {
                    pos[i].innerHTML = '<div><span class="pos-span"><span id="transpChars' + i + '"><span style="display: flex;"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1134440/icon' + plChar + '.png" style="width: 50px; margin: auto;"></span></span></span></div>';
                }
                if (!plFirst) {
                    aiTurn();
                }
            }
            // --- /\ /\ /\  Before Game Start /\ /\ /\ ---


            // --- \/ \/ \/  After Game Start \/ \/ \/ ---
            // </> Checks for Victory
            function checkVictory(who) {
                var inx = [],
                    i;
                for (i = 0; i < 9; i++) {
                    if (gameMain[i] === who) {
                        inx.push(i);
                    }
                }
                for (var j = 0; j < 8; j++) {
                    var win = winCond[j];
                    if (inx.indexOf(win[0]) !== -1 &&
                        inx.indexOf(win[1]) !== -1 &&
                        inx.indexOf(win[2]) !== -1) {
                        randomEmoji(1, aiTalksWin);
                        for (let k = 0; k < 3; k++) {
                            setTimeout(function() {
                                document.getElementById("div" + win[k]).className = "win";
                            }, 350 * (k + 1));
                        }

                        gameStarted = false;
                        aiScore++;
                        document.getElementById("score-ai").innerHTML = aiScore;
                        setTimeout(function() {
                            restart("tie");
                        }, 2000);
                        return true;
                    }
                }
                if (gameMain.indexOf("0") === -1) {
                    gameStarted = false;
                    randomEmoji(1, aiTalksTie);
                    setTimeout(function() {
                        for (let k = 0; k < 9; k++) {
                            setTimeout(function() {
                                document.getElementById("div" + [k]).innerHTML = "";
                            }, 125 * (k + 1));
                        }
                    }, 500);

                    setTimeout(function() {
                        restart("tie");
                    }, 2100);
                    tieScore++;
                    document.getElementById("score-tie").innerHTML = tieScore;
                    return true;
                } else if (who === aiChar && gameMain.indexOf(plChar) !== -1) {
                    randomEmoji(0.3, aiTalksMove);
                }
                return false;
            }

            // </> Restart Game
            function restart(x) {
                for (var i = 0; i < 9; i++) {
                    document.getElementById("pos" + i).innerHTML = '<a href="javascript:void(' + i + ');" onclick="playerMove(' + i + ');" class="pos"></a>';
                }
                gameMain = ["0", "0", "0",
                    "0", "0", "0",
                    "0", "0", "0"
                ];
                startGame();
                disableRestart = false;
            }

            // </> Write a Move
            function writeOnGame(pos, char) {
                gameMain[pos] = char;
                document.getElementById("pos" + pos)
                    .innerHTML = "<div  class='taken' id='div" + pos + "'><span style='display: flex;'><img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/1134440/icon" + char + ".png' style='width: 50px; margin: auto;'></span></div>";
            }

            // </> Ai Triger and Equal Value Ai Move Randomizer
            function aiTurn() {
                var posArr = ai();
                var ran = Math.floor(Math.random() * posArr.length);
                writeOnGame(posArr[ran], aiChar);
                checkVictory(aiChar);
            }

            // </> Player Click
            var plMoveDisable = false

            function playerMove(pos) {
                if (gameStarted && !plMoveDisable) {
                    plMoveDisable = true;
                    writeOnGame(pos, plChar);
                    var win = checkVictory(plChar);
                    if (win) {
                        return;
                    }
                    setTimeout(function() {
                        aiTurn();
                        plMoveDisable = false;
                    }, 450);
                }
            }
            // --- /\ /\ /\  After Game Start /\ /\ /\ ---

            // --- \/ \/ \/ AI \/ \/  \/ ---
            // </> MinMax algo
            function ai() {
                if (gameStarted) {

                    function isOpen(gameState, pos) {
                        return gameState[pos] === "0";
                    }

                    function didWin(gameState, val) {
                        var inx = [],
                            i;
                        for (i = 0; i < 9; i++) {
                            if (gameState[i] === val) {
                                inx.push(i);
                            }
                        }
                        for (var i = 0; i < 8; i++) {
                            if (inx.indexOf(winCond[i][0]) !== -1 &&
                                inx.indexOf(winCond[i][1]) !== -1 &&
                                inx.indexOf(winCond[i][2]) !== -1) {
                                return true;
                            }
                        }
                        return false;
                    }

                    function findScore(scores, x) {
                        if (scores.indexOf(x) !== -1) {
                            return x;
                        } else if (scores.indexOf(0) !== -1) {
                            return 0;
                        } else if (scores.indexOf(x * -1) !== -1) {
                            return x * -1;
                        } else {
                            return 0;
                        }
                    }

                    var scoresMain = ['0', '0', '0', '0', '0', '0', '0', '0', '0'];

                    function findBestMove() { // MAIN FUNCTION
                        for (var i = 0; i < 9; i++) {
                            if (isOpen(gameMain, i)) {
                                var simGame = gameMain.slice();
                                simGame[i] = aiChar;
                                if (didWin(simGame, aiChar)) {
                                    scoresMain[i] = 1;
                                } else {
                                    scoresMain[i] = plSim(simGame);
                                }
                            }
                        }
                        var bigest = -99;
                        for (var j = 0; j < 9; j++) {
                            if (scoresMain[j] !== '0' && scoresMain[j] > bigest) {
                                bigest = scoresMain[j];
                            }
                        }
                        var inx = [],
                            i;
                        for (i = 0; i < 9; i++) {
                            if (scoresMain[i] === bigest) {
                                inx.push(i);
                            }
                        }
                        console.log(gameMain.slice(0, 3), scoresMain.slice(0, 3));
                        console.log(gameMain.slice(3, 6), scoresMain.slice(3, 6));
                        console.log(gameMain.slice(6, 9), scoresMain.slice(6, 9));
                        return inx;
                    }

                    function plSim(simGame) { // PL SIM
                        var simGameTest = simGame.slice();
                        for (var i = 0; i < 9; i++) {
                            if (isOpen(simGame, i)) {
                                simGameTest = simGame.slice();
                                simGameTest[i] = plChar;
                                if (didWin(simGameTest, plChar)) {
                                    return -1;
                                }
                            }
                        }
                        var plScores = ['0', '0', '0', '0', '0', '0', '0', '0', '0'];
                        for (var j = 0; j < 9; j++) {
                            if (isOpen(simGame, j)) {
                                simGameTest = simGame.slice();
                                simGameTest[j] = plChar;
                                plScores[j] = aiSim(simGameTest);
                            }
                        }
                        return findScore(plScores, -1);
                    }

                    function aiSim(simGame) { // AI SIM
                        var simGameTest = simGame.slice();
                        for (var i = 0; i < 9; i++) {
                            if (isOpen(simGame, i)) {
                                simGameTest = simGame.slice();
                                simGameTest[i] = aiChar;
                                if (didWin(simGameTest, aiChar)) {
                                    return 1;
                                }
                            }
                        }
                        var aiScores = ['0', '0', '0', '0', '0', '0', '0', '0', '0'];
                        for (var j = 0; j < 9; j++) {
                            if (isOpen(simGame, j)) {
                                simGameTest = simGame.slice();
                                simGameTest[j] = aiChar;
                                aiScores[j] = plSim(simGameTest);
                            }
                        }
                        return findScore(aiScores, 1);
                    } // aiSim()
                    return findBestMove();
                }
            } // ai() end

            charsBtnGen();
        </script>


    </body>

    </html>
<?php
}
?>