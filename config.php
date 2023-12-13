<?php
    $host       = "localhost";
    $user       = "root";
    $password   = "";
    $dbname     = "touchid";
    /** @var bool|mysqli $link */
    $link = mysqli_connect($host,$user,$password,$dbname);

    if(!$link){
        echo "Baza bilan bo'glanib bo'lmadi, Xatolik: " . mysqli_connect_error();
    }

    function dbQuery($sql) {
        global $link;
        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
        return $result;
    }

    function dbFetchAssoc($result)
    {
        return mysqli_fetch_assoc($result);
    }

    function dbNumRows($result)
    {
        return mysqli_num_rows($result);
    }

    function closeConn() {
        global $dbConn;
        mysqli_close($dbConn);
    }
