<?php
header('Content-type:application/json;charset=utf-8');

$a = $_REQUEST['a'];
$b = $_REQUEST['b'];

$mysqli = new mysqli("120.77.209.12","elf","flyelf37", "mercury");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

/* Select queries return a resultset */
if ($result = $mysqli->query("SELECT * FROM tbl_idpassword")) {
    $ans = false;
    while ($row = $result->fetch_row()) {
        if ($row[0] == $a && $row[1] == $b)
        {
            $ans = true;
            break;
        }
    }

    echo json_encode(array('login_success' => $ans));

    /* free result set */
    $result->close();
}

$mysqli->close();