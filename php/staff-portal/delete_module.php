<?php
include("../connection/config.php");
if (isset($_GET['deleteid'])) {
    $userId = $_GET['deleteid'];
    $examID = $_GET['examid'];
    $query = "DELETE FROM module_result WHERE module_id = '$userId' AND exam_id = '$examID'";
    mysqli_select_db($conn, 'universityofsam');
    $deleteResult = mysqli_query($conn, $query);

    if ($deleteResult) {
        echo "<script>
    if (confirm('One Subject has been Deleted Successfully')) {
        window.location.href = 'result_view.php?editid=$examID';
    } else {
        window.location.href = 'result_view.php?editid=$examID';
    }
</script>";
    } else {
        echo '<script>alert("Error: Unable to update the record.");</script>';
    }
    mysqli_close($conn);
}
