<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("../connection/config.php");

    $mark = $_POST['mark'];
    $Module_id = $_POST['Module_id'];
    $Exam_id = $_POST['Exam_id'];

    $query = "INSERT INTO module_result(exam_id,module_id,marks) VALUES ('$Exam_id','$Module_id','$mark')";
    mysqli_select_db($conn, 'universityofsam');

    $updateResult = mysqli_query($conn, $query);

    if ($updateResult) {
        echo "<script>
    if (confirm('One Subject has been added Successfully')) {
        window.location.href = 'result_add.php?editid=$Exam_id';
    } else {
        window.location.href = 'result_add.php?editid=$Exam_id';
    }
</script>";
    } else {
        echo '<script>alert("Error: Unable to update the record.");</script>';
    }
    mysqli_close($conn);
}
