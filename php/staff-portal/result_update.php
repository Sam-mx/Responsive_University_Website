<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("../connection/config.php");

    $mark = $_POST['mark'];
    $Module_id = $_POST['Module_id'];
    $Exam_id = $_POST['Exam_id'];

    $query = "UPDATE module_result SET marks='$mark' WHERE module_id='$Module_id' AND exam_id='$Exam_id'";
    mysqli_select_db($conn, 'universityofsam');

    $updateResult = mysqli_query($conn, $query);

    if ($updateResult) {
        echo "<script>
                if (confirm('Your Information has been updated!!')) {
                    window.location.href = 'result_view.php?editid=$Exam_id';
                } else {
                    window.location.href = 'result_view.php?editid=$Exam_id';
                };</script>";
    } else {
        echo '<script>alert("Error: Unable to update the record.");</script>';
    }
    mysqli_close($conn);
}
