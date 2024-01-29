<?php
include("../connection/config.php");
if (isset($_GET['deleteid'])) {
    $userId = $_GET['deleteid'];
    $query = "DELETE FROM student WHERE student_id=$userId";
    mysqli_select_db($conn, 'universityofsam');
    $deleteResult = mysqli_query($conn, $query);
    if ($deleteResult) {
        echo "<script>
                if (confirm('Your Information has been Deleted!!')) {
                    window.location.href = 'student_info.php';
                } else {
                    window.location.href = 'student_info.php';
                };</script>";
    } else {
        echo '<script>alert("Error: Unable to delete the record.");</script>';
    }
    mysqli_close($conn);
} else {
    echo "User ID not provided in the URL.";
}
