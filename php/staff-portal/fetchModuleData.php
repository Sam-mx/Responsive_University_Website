<?php
include("../connection/config.php");

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $query = "SELECT module_name
    FROM
       module_detail
    WHERE
    module_id = '$userId'";
    mysqli_select_db($conn, 'universityofsam');
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    }
}
