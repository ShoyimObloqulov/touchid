<?php
    include_once '../config.php';
    $result = [];
    if (isset($_GET['id'])){
        $id = intval($_GET['id']);
        $sql = mysqli_query($link,"SELECT `name`, `call`,`position`,`definition` FROM `users` WHERE id='$id'");
        $date = mysqli_fetch_assoc($sql);
    }

    elseif(isset($_GET['definition'])){
        $definition = strval($_GET['definition']);
        $sql = mysqli_query($link,"SELECT `name`, `call`,`position`,`definition` FROM `users` WHERE definition='$definition'");
        $date = mysqli_fetch_assoc($sql);
    }

    $result = [
        "id"         => $id,
        "data"       => $date,
        "definition" => $definition
    ];

    echo json_encode($result);