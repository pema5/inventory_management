<?php
include "db.php";

if (isset($_GET['code'])) {
    $code = intval($_GET['code']);

    $stmt = $conn->prepare(
        "SELECT productname, producttype, salesrate FROM productentry WHERE productcode = ?"
    );
    $stmt->bind_param("i", $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(null);
    }

    $stmt->close();
}
?>
