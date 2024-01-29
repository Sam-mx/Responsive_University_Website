<?php
include("../connection/config.php");
if (isset($_GET['deleteid'])) {
    $userId = $_GET['deleteid'];
    $query = "DELETE FROM exam_result WHERE student_id=$userId";
    mysqli_select_db($conn, 'universityofsam');
    mysqli_query($conn, $query);
    mysqli_close($conn);
    header('Location:student_result.php');
    exit();
} else {
    echo "User ID not provided in the URL.";
}
