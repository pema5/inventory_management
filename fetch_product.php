<?php
include "db.php";

if (isset($_GET['code'])) {

    $code = intval($_GET['code']);

    $sql = "SELECT productname, producttype, salesrate 
            FROM productentry 
            WHERE productcode='$code'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        echo json_encode(mysqli_fetch_assoc($result));
    } else {
        echo json_encode(null);
    }
}
?>
