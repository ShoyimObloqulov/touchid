<?php
require_once '../config.php';
require_once '../jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

$bearer_token = get_bearer_token();

#echo $bearer_token;

$is_jwt_valid = is_jwt_valid($bearer_token);


if($is_jwt_valid) {
    $response = (array) json_decode(file_get_contents("php://input"),TRUE);

    $definition = $response['definition'];
    $user = mysqli_query($link,"SELECT * FROM `users` WHERE definition='$definition' LIMIT 1");
    $user_row = mysqli_fetch_assoc($user);

    $sql = "SELECT * FROM `schedule` WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = CURDATE()";

    $result = mysqli_query($link, $sql);

    $date = date('Y-m-d H:M:S');
    $user_id = $user_row['id'];

    if (mysqli_num_rows($result) > 0) {
        $s = 1 - mysqli_num_rows($result) % 2;
        $sql = mysqli_query($link,"INSERT INTO `schedule`(`status`, `user_id`, `created_at`) VALUES ('$s','$user_id','$date')");
    } else {
        $sql = mysqli_query($link,"INSERT INTO `schedule`(`status`, `user_id`, `created_at`) VALUES ('1','$user_id','$date')");
    }

    if($sql){
        echo json_encode([
            "success"   => 1,
            "message"   => "Yozildi",
        ]);
    }
}
else {
    echo json_encode([
        "success"   => 0,
        "message"   => "Foydalanuvchiga ruxsat bekor qilingan"
    ]);
}