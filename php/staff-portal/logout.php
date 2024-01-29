<?php
session_start();
if (isset($_SESSION["sess_user"])) {
    session_destroy();
    header('Location: ../staff.php');
} else {
    header('Location: staff_portal.php');
}
