<?php
    require_once '../config.php';

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    $response = (array) json_decode(file_get_contents("php://input"),TRUE);

    $definition = $response['definition'];

    $user = mysqli_query($link,"SELECT * FROM `users` WHERE definition='$definition' LIMIT 1");
    $user_row = mysqli_fetch_assoc($user);
    $date = $response['date'];
    $user_id = $user_row['id'];
    $sql = mysqli_query($link,"SELECT * FROM `schedule`WHERE user_id='$user_id' AND DATE_FORMAT(created_at, '%Y-%m-%d') = '$date'");
    $data = [];

    while ($fetch = mysqli_fetch_assoc($sql)){
        $data[] = [
            "status"        => (($fetch['status'] == 1) ? "Kirgan" : "Chiqan"),
            "code"          => $fetch['status'],
            "created_at"    => $fetch['created_at'],
        ];
    }

    echo  json_encode([
        "success"   => 1,
        "user"      => [
            "name"  => $user_row['name'],
            "call"  => $user_row['call']
        ],
        "data"      => $data
    ]);

