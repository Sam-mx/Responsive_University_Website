<?php
include("../connection/config.php");

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $examId = $_GET['exam_id'];

    $query = "SELECT module_detail.module_name, 
    module_result.marks,
    module_result.module_id 
    FROM
        module_result 
    JOIN
        module_detail ON module_result.module_id= module_detail.module_id
    WHERE
        module_result.module_id = '$userId' 
    AND 
        module_result.exam_id = '$examId'";
    mysqli_select_db($conn, 'universityofsam');
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    }
}
