<?php


    $servername = "localhost";
    $username = "root";
    $password = "Obejansen.1";
    $database = "cities";

    $conn = new mysqli($servername, $username, $password, $database) or die("Connect failed: %s\n". $conn->error);

    function getAll($conn) {
        $sql = "SELECT * FROM `cities`";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row;
            }
        } else {
            echo "404";
        }

//        while ($rij = mysqli_fetch_assoc($result)) {
//            $aJSON[] = array_map("utf8_encode", $rij);
//        }
//        $oJSON = json_encode($aJSON);
//        return $oJSON;
    }
getAll($conn);
