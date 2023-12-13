<?php

require_once '../config.php';
require_once '../jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get posted data
    $data = json_decode(file_get_contents("php://input", true));

    $sql = "SELECT * FROM `users` WHERE login = '" . mysqli_real_escape_string($link, $data->login) . "' AND password = '" . md5(mysqli_real_escape_string($link, $data->password)) . "' LIMIT 1";

    $result = dbQuery($sql);

    if(dbNumRows($result) < 1) {
        echo json_encode([
            "success"   => 0,
            "message"   => "Foydalanuvchi mavjud emas"
        ]);
    } else {
        $row = dbFetchAssoc($result);

        $username = $row['login'];

        $headers = array('alg'=>'HS256','typ'=>'JWT');
        $payload = array('username'=>$username, 'exp'=>(time() + 60));

        $jwt = generate_jwt($headers, $payload);

        echo json_encode([
            "success"   => 1,
            "token"     => $jwt
        ]);
    }
}