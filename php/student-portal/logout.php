<?php
session_start();
if (isset($_SESSION["sess_user"])) {
    session_destroy();
    header('Location: ../student.php');
} else {
    header('Location: student_portal.php');
}
